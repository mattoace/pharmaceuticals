<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class CatController extends CI_Controller {
 
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Cat','cat');
    }
 
    public function index()
    {
        $this->load->helper('url');
        
    }
 
    public function fetch()
    {
        $list = $this->cat->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $cat) {
            $no++;
            $row = array();
            $row[] = $cat->id;
            $row[] = $no;
            $row[] = $cat->categoryname;
            $row[] = $cat->description;         
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->cat->count_all(),
                        "recordsFiltered" => $this->cat->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

    public function addNew(){  
         

                 $array = array(
                    'categoryname' => $this->input->post("categoryname") ,
                    'description' => $this->input->post("description")
                );          

            $qcd = $this->cat->addNew($array);

    }

    public function fetchedit(){
        $list = $this->cat->fetchedit($this->input->post("id") );
        echo json_encode ($list->row_array());
    }

    public function edit(){

                 $array = array(
                    'categoryname' => $this->input->post("categoryname") ,
                    'description' => $this->input->post("description")
                );          

            $qcd = $this->cat->saveRecord($array,$this->input->post("id"));

    } 

 public function deleteRecord(){
        $qcd = $this->cat->deleteRecord($this->input->post("id"));
 }

 public function loadTree(){


      if ( stristr($_SERVER["HTTP_ACCEPT"],"application/xhtml+xml") ) {
                 header("Content-type: application/xhtml+xml"); } else {
                 header("Content-type: text/xml");
        }
        echo("<?xml version=\"1.0\" encoding=\"iso-8859-1\"?>\n");
             $main = $this->cat->getParentCategories(); 
               print("<tree id='0'".">\n");      
                 foreach ($main  as $key => $maintree) {
                  print("<item state=\"0\" text='".$maintree->categoryname ."' id='".$maintree->id ."'".">"."\n");

                    $child1 = $this->cat->getChildCategories($maintree->id);

                      foreach ($child1  as $key => $childtree1) {
                            print("<item state=\"0\" text='".$childtree1->categoryname ."' id='".$childtree1->id ."'".">"."\n");

                            $child2 = $this->cat->getChildCategories($childtree1->id);

                            foreach ($child2  as $key => $childtree2) {
                                    print("<item state=\"0\" text='".$childtree2->categoryname ."' id='".$childtree2->id ."'".">"."\n");

                                        $child3 = $this->cat->getChildCategories($childtree2->id);
                                        foreach ($child3  as $key => $childtree3) {
                                         print("<item state=\"0\" text='".$childtree3->categoryname ."' id='".$childtree3->id ."'".">"."\n");

                                         $child4 = $this->cat->getChildCategories($childtree3->id);
                                            foreach ($child4  as $key => $childtree4) {
                                             print("<item state=\"0\" text='".$childtree4->categoryname ."' id='".$childtree4->id ."'".">"."\n");

                                                    $child5 = $this->cat->getChildCategories($childtree4->id);
                                                    foreach ($child5  as $key => $childtree5) {
                                                     print("<item state=\"0\" text='".$childtree5->categoryname ."' id='".$childtree5->id ."'".">"."\n");

                                                      print("</item>\n"); 
                                                     }

                                              print("</item>\n"); 
                                             }


                                          print("</item>\n"); 
                                         }


                                     print("</item>\n");  

                                }

                            print("</item>\n");  
                      }
                        
                  print("</item>\n");   
                }                
               print("    </tree>\n"); 


  }

  public function loadContext(){

     header("Content-type:text/xml");
        print('<menu id="0" >');
        
                print('<item text="Add Node"  img="add.png"  id="main_add">');
                         print('<item text="Add root node"  img="create_add.png"  id="addparent"/>');
                         print('<item text="Add on selected node"  img="add.png"  id="add"/>');
                         print('</item>');
        
        print('<item text="Rename Node"  img="rename.png"  id="rename"/>');
        print('<item text="Delete node"  img="delete.png"  id="delete"/>');
        print('</menu>');

  }

  public function saveContext(){

          $bool = false;        
          
                  switch($this->input->get('nodeType'))
                  {
                  
                  case 1:  //to add on the selected node 
                      $array = array(
                            'categoryname' => $this->input->get('topic'),
                            'description' => $this->input->get('topic'),
                            'parent'=>$this->input->get('cat')
                        ); 
                     $max_cat = $this->cat->addNew($array);

                      $info = "Item inserted on selected node!";  
                      $bool = true; 
                  break;                  
                  case 2: // to add on the root node of the tree  
                      $array = array(
                            'categoryname' => $this->input->get('topic'),
                            'description' => $this->input->get('topic')
                        ); 
                      $max_cat = $this->cat->addNew($array);
                      $info = "Root node inserted!";             
                    $bool = true;  
                  break;
                  case 3: 
                      $array = array(
                            'categoryname' => $this->input->get("topic") ,
                            'description' => $this->input->get("topic")
                        );          
                      $max_cat = $this->input->get("cat"); 
                      $info = "Renamed!";
                      $this->cat->saveRecord($array,$this->input->get("cat"));
                      $bool = true;  
                  break; 
                   
                  } 
         $data = array('info'=>$info,'id'=>$max_cat,'dataItemName'=>$this->input->get('topic'),"bool"=>$bool,"childid"=>$max_cat);   
         echo  json_encode($data);

  }

  public function deleteTreeAll(){
   echo  json_encode(array("response"=>$this->cat->deleteAllRecord($this->input->get('childItem'))));
  }

  public function deleteTree(){
    echo  json_encode(array( "response"=>$this->cat->deleteRecord($this->input->get("childItem"))));    
  }
 
}
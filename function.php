<?php
  function getProducts($id=0)
  {
    global $conn;
    $query = "SELECT * FROM produit";
    if($id != 0)
    {
      $query .= " WHERE id=".$id." LIMIT 1";
    }
    $response = array();
    $result = mysqli_query($conn, $query);
    while($row = mysqli_fetch_array($result))
    {
      $response[] = $row;
    }
    header('Access-Control-Allow-Headers: Access-Control-Allow-Origin, Content-Type');
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json, charset=utf-8');
    echo json_encode($response, JSON_PRETTY_PRINT);
  }


  function AddProduct()
  {
    global $conn;
    $name = $_POST["name"];
    $description = $_POST["description"];
    $price = $_POST["price"];
    $category = $_POST["category"];
    $created = date('Y-m-d H:i:s');
    $modified = date('Y-m-d H:i:s');

    echo $query="INSERT INTO produit(name, description, price, category_id, created, modified) VALUES('".$name."', '".$description."', '".$price."', '".$category."', '".$created."', '".$modified."')";

    if(mysqli_query($conn, $query))
    {
      $response=array(
        'status' => 1,
        'status_message' =>'Produit ajoute avec succes.'
      );
    }
    else
    {
      $response=array(
        'status' => 0,
        'status_message' =>'ERREUR!.'. mysqli_error($conn)
      );
    }
    header('Access-Control-Allow-Headers: Access-Control-Allow-Origin, Content-Type');
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json, charset=utf-8');
    echo json_encode($response);
  }



  function updateProduct($id)
  {
    global $conn;
    $_PUT = array(); //tableau qui va contenir les données reçues

    
    $name = $_PUT["name"];
    $description = $_PUT["description"];
    $price = $_PUT["price"];
    $category = $_PUT["category"];
    $modified = date('Y-m-d H:i:s');
    //construire la requête SQL
    $query="UPDATE produit SET name='".$name."', description='".$description."', price='".$price."', category_id='".$category."', modified='".$modified."' WHERE id=".$id;
    
    if(mysqli_query($conn, $query))
    {
      $response=array(
        'status' => 1,
        'status_message' =>'Produit mis a jour avec succes.'
      );
    }
    else
    {
      $response=array(
        'status' => 0,
        'status_message' =>'Echec de la mise a jour de produit. '. mysqli_error($conn)
      );
      
    }
    
    header('Content-Type: application/json');
    echo json_encode($response);
  }
  

  function deleteProduct($id)
  {
    global $conn;
    $query = "DELETE FROM produit WHERE id=".$id;
    if(mysqli_query($conn, $query))
    {
      $response=array(
        'status' => 1,
        'status_message' =>'Produit supprime avec succes.'
      );
    }
    else
    {
      $response=array(
        'status' => 0,
        'status_message' =>'La suppression du produit a echoue. '. mysqli_error($conn)
      );
    }

    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
    echo json_encode($response);
  }
  
?>
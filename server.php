<?php
$q = $_GET['q'];
$d = $_GET['d'];
$u = $_GET['u'];
$e = $_GET['e'];

$text = $_GET['text'];
$conn = mysqli_connect('localhost',"ajax","","ajax");

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
else{

  function select($q,$conn){
    $sql = "select * from users where name like '".trim($q)."%' order by name asc";
    $result = mysqli_query($conn, $sql);
    
    if (mysqli_num_rows($result) > 0) {
      $i = 0;
      while($row = mysqli_fetch_assoc($result)) {
        $i++;
        echo "<tr><td>".$i."</td><td>".$row['name']."</td><td> <button value='".$row['id']."' onclick='confirmation(this.value)'>Delete</button><button value='".$row['id']."' onclick='edit(this.value)'>Edit</button></td></tr>";
      }
      echo "<br>";
    }
    else{
      echo "0 results";
      //echo trim($q);
    }
  }
 

  function delete($d,$conn){
    $sql = "delete from users where id='".$d."'";
    $result = mysqli_query($conn, $sql);
    ///select();
  }

  function update($text,$e,$conn){
    $sql = "update users set name='".$text."' where id='".$e."'";
    $result = mysqli_query($conn,$sql);
    //select();
  }

  function insert($u,$conn){
    $sql = "insert into users(name) values('".$u."')";
    $result = mysqli_query($conn, $sql);
    //select();
  }

  // if(!$q==""){
  //   select($q);
  // }

  if(isset($d)){
    delete($d,$conn);
    select($q,$conn);
  }else if(isset($u)){
    insert($u,$conn);
    select($q,$conn);
  }elseif(isset($e)){
    update($text,$e,$conn);
    select($q,$conn);
  }
  else if(!$q==""){
    select($q,$conn);
  }

  mysqli_close($conn);
}
?>

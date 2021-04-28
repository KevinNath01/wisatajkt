<?php
$connect = mysqli_connect("localhost","root","","wisatajkt_api");
$response = array ();
if($connect){
    $sql = "select * from wisata";
    $result = mysqli_query($connect,$sql);
    if($result){
        header("Content-Type: JSON");
        $i=0;
        while($row = mysqli_fetch_assoc($result)){
            $response[$i]['id_wisata'] = $row['id_wisata'];
            $response[$i]['nama'] = $row['nama'];
            $response[$i]['alamat'] = $row['alamat'];
            $response[$i]['lokasi'] = $row['lokasi'];
            $response[$i]['gambar'] = $row['gambar'];
            $response[$i]['telepon'] = $row['telepon'];
            $response[$i]['operasional'] = $row['operasional'];
            $response[$i]['website'] = $row['website'];
            $response[$i]['keterangan'] = $row['keterangan'];
            $response[$i]['tgl_update'] = $row['tgl_update'];
            $i++;
            echo "Database Connected";
        }
        echo json_encode($response,JSON_PRETTY_PRINT);
    }
}
else{
    echo "Database Connection Failed";
}
?>
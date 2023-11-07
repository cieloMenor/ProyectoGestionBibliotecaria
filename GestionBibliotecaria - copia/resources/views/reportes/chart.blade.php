@extends('layout.plantilla')

@section('titulo','Reporte - Gráfico')

@section('contenido')
<div class="container-fluid" id="chart-container">
    <?php 
    // Attempt select query execution
    try{
      $sql = "SELECT * FROM bd_biblioteca.lector";   
      $result = $pdo->query($sql);
      if($result->rowCount() > 0) {
        while($row = $result->fetch()) {
            echo $row['lectorID'];
        }
    
      unset($result);
      } else {
        echo "No records matching your query were found.";
      }
    } catch(PDOException $e){
      die("ERROR: Could not able to execute $sql. " . $e->getMessage());
    }
     
    // Close connection
   // unset($pdo);
    ?>
</div>
@endsection
@section('script')
<script src="https://code.highcharts.com/highcharts.js">
    
</script>
<script>
    //var datas = <?php echo json_encode ($datas) ?>

</script>
@endsection
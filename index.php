<?php
    include('inc/database.php');
    include('inc/styles.php');
?>

<br />
<div class="container">
<a href="new.php"><button type="button" class="btn btn-success"><i class="fas fa-plus-circle"></i> New</button></a>
<br /><br />
    <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th style="width:10%; text-align: center;">#</th>
                <th style='text-align: center;'>Title</th>
                <th style='text-align: center;'>Category</th>
                <th style='text-align: center;'>Rate</th>
            </tr>
        </thead>
        <tbody>
<?php

$sql = "SELECT * FROM moviesandseries";
$result = $conn->query($sql);
    
if ($result->num_rows > 0) {
    
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
            echo "<td style='text-align: center;'>#".$row["id"]."</td>";
            echo "<td><a href='new.php?id=".$row["id"]."'>".$row["title"]."</a></td>";
            
            echo "<td style='text-align: center;'>";
                if($row["category"] == 0){
                    echo "<span class='badge bg-primary'><i class='fas fa-film'></i> Movie</span>";
                } elseif($row["category"] == 1){
                    echo "<span class='badge bg-success'><i class='fas fa-video'></i> Serie</span>";
                } else {
                    echo "<span class='badge bg-secondary'>Unknown</span>";
                }
                
            echo "</td>";
            
            echo "<td style='text-align: center;'>";
            echo "<center><span class='badge bg-primary'>".$row["rating"]."</span></center>";
            echo "</td>";
        echo "</tr>";
    }

} else {
    echo "No Data";
}
?>
        </tbody>
    </table>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('#example').DataTable();
    } );
</script>
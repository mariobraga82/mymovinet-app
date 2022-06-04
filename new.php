<?php
    include('inc/database.php');
    include('inc/styles.php');

    $new = TRUE;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        try {

            $error = 0;

            if (!isset($_POST['title']) || $_POST['title'] === '') {
                $error += 1; 
            } else {
                $title = $_POST['title'];
            };

            if (!isset($_POST['category']) || intval($_POST['category']) === '' ) {
                $error += 1;
            } else {
                $category = $_POST['category'];
            };

            if (!isset($_POST['rating']) || intval($_POST['rating']) === '' ) {
                $error += 1;
            } else {
                $rating = $_POST['rating'];
            };

            if($error > 0){
                echo "<div class='alert alert-warning ' role='warning '> Fill in all Fields!</div>";
            } else {
                if($_POST["new"] == 1){
                    $sql = sprintf("UPDATE moviesandseries SET `title`='%s', `category`=%s, `rating`=%s WHERE `id` =%s",
                    $conn->real_escape_string($title),
                    $conn->real_escape_string($category),
                    $conn->real_escape_string($rating),
                    $conn->real_escape_string($_GET["id"]));

                } else {
                    $sql = sprintf("INSERT INTO moviesandseries (title, category, rating) VALUES ('%s', '%s', '%s')",
                    $conn->real_escape_string($title),
                    $conn->real_escape_string($category),
                    $conn->real_escape_string($rating));
                }

                if ($conn->query($sql) === TRUE) {
                    echo "<div class='alert alert-success  ' role='success  '> Data Saved</div>";
                  } else {
                    echo "<div class='alert alert-danger  ' role='danger  '>".$conn->error."</div>";
                  }

                $conn->query($sql);

            }
        
        } catch (Exception $e){
            echo "<div class='alert alert-danger' role='alert'> We cannot save!</div>";
        }
    } else {
        if(isset($_GET["id"])){
            $sql = "SELECT * FROM moviesandseries WHERE id=".$_GET["id"];
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $title = $row["title"];
                    $category = $row["category"];
                    $rating = $row["rating"];
                }
                $new = FALSE;
            } else {
                $new = TRUE;
            }
        } else {
            $new = TRUE;
        }
    }
?>

<a href="index.php"><button type="button" class="btn btn-success"><i class="fas fa-home"></i> Index</button></a>

<form method="POST" action="<?php echo basename($_SERVER['REQUEST_URI']); ?>">

    <div class="row row-cols-1 row-cols-md-3 container py-3">
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1"><i class="fas fa-font"></i></span>
            <input type="text" class="form-control" placeholder="Title" name="title" value="<?php echo $title ?? ''; ?>" required>
        </div>
    </div>

    <fieldset class="row mb-3 container">
        <legend class="col-form-label col-sm-12 pt-0">Category</legend>
        <div class="col-sm-4" style="margin-left: 3%;">
        <div class="form-check">
            <input class="form-check-input" type="radio" name="category" id="gridRadios1" value="0" <?php echo isset($category) && $category == 0 ? "checked" : "" ?>>
            <label class="form-check-label" for="gridRadios1">
            Movie
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="category" id="gridRadios2" value="1" <?php echo isset($category) && $category == 1 ? "checked" : "" ?>>
            <label class="form-check-label" for="gridRadios2">
            Serie
            </label>
        </div>
        </div>
    </fieldset>

    <fieldset class="row mb-3 container">
        <legend class="col-form-label col-sm-12 pt-0">Rating</legend>
        <div class="col-sm-10" style="margin-left: 3%;">
        <div class="form-check">
        <input type="range" class="form-range" min="0" max="10" value="<?php echo $rating ?? ''; ?>" id="rating" name="rating" required>
        <p style="text-align: initial;">Value: <span id="value"></span></p>
        </div>
        </div>
    </fieldset>
  
    <center>
        <hr style="width:95%">
        <?php
            if($new){
                echo "<input type='hidden' id='new' name='new' value='0'>";
                echo "<button type='submit' class='btn btn-primary'><i class='fas fa-save'></i> Save</button>";
            } else {
                echo "<input type='hidden' id='new' name='new' value='1'>";
                echo "<button type='submit' class='btn btn-primary'><i class='fas fa-edit'></i> Update</button>";
            }
        ?>
        
    </center>
</form>


<script type="text/javascript">
    var slider = document.getElementById("rating");
    var output = document.getElementById("value");
    output.innerHTML = slider.value;
    
    slider.oninput = function() {
        output.innerHTML = this.value;
    }
</script>
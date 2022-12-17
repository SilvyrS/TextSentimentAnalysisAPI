<?php 
    include('db.php');

?>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="css/layout.css">
	<script type="text/javascript" charset="utf8" src="/DataTables/datatables.js"></script>
	<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
	<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <title>Document</title>
</head>
<body>
<div class="submission">
    <div class="layerTwo">
    <h1>Text Sentiment Analysis</h1>
            <div class="enterText">
                <input type="text" id="text" placeholder="Text Here"><br>
                <input type="submit" value="Analyse" id="submit" onclick="getSentiment()"><br>
            </div>               
            <h2>State: <span id="state"></span></h2><br>
        </div>
        </div>
</div>

<div class="subm">
</div>

        <script>
            function getSentiment(){
                var getText = document.getElementById("text").value;
                const api_url = "result.php?sent=" + getText;

                async function getStudentData(){
                    const response = await fetch(api_url);
                    const data = await response.json();
                    console.log(data.State);
                    document.getElementById("state").innerHTML = data.State;
                }
                getStudentData();
            }
        </script>

        <div class= "wholeTable">
    <div class = "giveData">
        <form action="actions/AddCorpus.php" method="get">
            <input type="text" name="corpusWord" placeholder="New corpus word">
            <input type="number" name="corpusWeight" placeholder="Weight" >
            <input type="submit">
        </form>
    </div>
    <table id="corpus_table" class="display">
    <thead>
        <tr>
            <th>Word ID</th>
            <th>Text</th>
            <th>Weight</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php 
			$sql = "SELECT * FROM wordlist";
			$result = $conn->query($sql);
		?>
			<?php if ($result->num_rows > 0): ?>
				<?php while($row = $result->fetch_assoc()): ?>
					<tr>
						<td><?php echo $row["ID"]; ?></td>
						<td><?php echo $row["text"]; ?></td>	
						<td><?php echo $row["weight"]; ?></td>	
						<td>
                            <button class="action update" 
                                data-id="<?php echo $row["ID"]; ?>"
                                data-word="<?php echo $row["text"]; ?>"
                                data-weight="<?php echo $row["weight"];?>">Update
                            </button>
                            <a onclick="return alert('Word Deleted');" href="actions/DeleteCorpus.php?wordid=<?php echo $row["ID"];?>">Delete</a>
                        </td>
					</tr>

				<?php endwhile; ?>
			<?php endif; ?>

			<?php $conn->close(); ?>
    </tbody>
</table>
                </div>

                    
<div id="updateModal" class="modal">
	<!-- Modal content -->
	<div class="modal-content">
		<form action="actions/UpdateCorpus.php" method="POST">
			<div class="header">
				<h3 id="Title">Update</h3>
				<span class="close">&times;</span>
			</div>
				<div class="form-group">
					<input type="text" id="wordText"class="form-control" name="Word" placeholder="Word">
				</div>
				<div class="form-group">
					<input type="number" id="wordWeight" class="form-control" name="Weight" placeholder="Weight">
				</div>
                <!-- Word ID --><input name="wordID" id="wordID" type="hidden">
				<div class="form-group">
					<button type="submit" name="submit"class="btn btn-primary">Update</button>
				</div>
		</form>
	</div>
</div>    

<script>
    $(document).ready( function () {
    $('#corpus_table').DataTable();
});
</script>
<script>
    $(".update").click(function(){
        $("#updateModal").show();
        var word = $(this).data("word");
        var weight = $(this).data("weight");
        var wordID = $(this).data("id");

        $("#wordText").val(word);
        $("#wordWeight").val(weight);
        $("#wordID").val(wordID);
        });

        $(".close").click(function(){
        $("#updateModal").hide();
        });
</script>

</body>
</html>
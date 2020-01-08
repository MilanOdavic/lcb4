<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>

	<script type="text/javascript">

		$(document).ready(function(){

			var buttonpressed;
	    $('button').click(function() {
	          buttonpressed = $(this).attr('value');
	    });

			$('.formCategorie').on('submit',function(e){
				if(buttonpressed=='delete') {
						e.preventDefault();

						if (!confirm("Click OK if you are sure")) {return false;}

						var categorieId = $(this).find('input[name="categorieId"]').val();

						$.ajax({
							 url:"delete_categorie",
							 method:"POST",
							 data:{categorieId: categorieId},
							 success:function(responseJson)
							 {
								 alert('Success deleted');
							 }
						});
				}

			});

		});
	</script>

<a href='<?php echo $urlIndex;?>'> Home </a> &nbsp&nbsp&nbsp | &nbsp&nbsp&nbsp
<a href='<?php echo $urlArticles;?>'> Articles </a> &nbsp&nbsp&nbsp | &nbsp&nbsp&nbsp
<a href='<?php echo $urlCategories;?>'> Categories </a> &nbsp&nbsp&nbsp | &nbsp&nbsp&nbsp

<h2> MESSAGES:  </h2>
<?php
  echo $message;
?>

  <br/><br/><hr/><br><br/>

<h2> Create Categories </h2>

<?php
if($userId != '') {
?>
<form action='create_categorie' method='POST' >
  title: <input type='text' name='tbTitle' /> <br/>
  <input type='submit' name='btnCreateCategorie' value='Create categorie'/>
</form>

<?php
}
else {
  echo "First log in, and then you can create.";
}
?>

  <br/><br/><hr/><br><br/>

<h2> Categories (Read + Update + Delete) </h2>
<?php
	if(isset($categories)) {
		  foreach($categories as $row) {
		    if ($row->getUsersId()->getId() == $userId) {
		      echo "<form action='update_categorie' method='POST' class='formCategorie'>";
		        echo "id: " . $row->getId() . " *** ";
		        echo "title: <input type='text' name='tbTitle' value='".$row->getTitle()."'/> *** ";
		        echo "<input type='hidden' id='categorieId' name='categorieId' value='".$row->getId()."'>";
						echo "<button type='submit' name='btnUpdateCategorie' value='update'>Update</button>";
						echo "<button type='submit' name='btnDeleteCategorie' value='delete'>Delete</button>";
		      echo "</form>";
		    }
		    else
		    {
		      echo 'id: ' .  $row->getId()  .  ' *** title: ' . $row->getTitle() . ', <br/>';
		    }
		  }
		}
?>

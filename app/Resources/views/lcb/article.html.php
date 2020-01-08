
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>

	<script type="text/javascript">

		$(document).ready(function(){

			var buttonpressed;
	    $('button').click(function() {
	          buttonpressed = $(this).attr('value');
	    });

			$('.form_article').on('submit',function(e){
				if(buttonpressed=='delete') {
						e.preventDefault();

						if (!confirm("Click OK if you are sure")) {return false;}

						var articleId = $(this).find('input[name="articleId"]').val();

						$.ajax({
							 url:"delete_article",
							 method:"POST",
							 data:{articleId: articleId},
							 success:function(responseJson)
							 {
								 alert('Success deleted');
							 }
						});
				}
			});

			$('.formComment').on('submit',function(e){
				if(buttonpressed=='delete') {
						e.preventDefault();

						if (!confirm("Click OK if you are sure")) {return false;}

						var commentId = $(this).find('input[name="commentId"]').val();

						$.ajax({
							 url:"delete_comment",
							 method:"POST",
							 data:{commentId: commentId},
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

<h2> 3. Create Article </h2>

<?php
if($userId != '') {
?>
<form action='create_article' method='POST' >
  categoriesId: <input type='text' name='tbCategoriesId' /> <br/>
  text: <input type='text' name='tbText' /> <br/>
  title: <input type='text' name='tbTitle' /> <br/>
  <input type='submit' name='btnCreateArticle' value='Create article'/>
</form>

<?php
}
else {
	  echo "First log in, and then you can create.";
}
?>

<br/><br/><hr/><br><br/>

<h2> 5. Articles (Read + Update + Delete) AND Comments</h2>
	<?php

		// >>>>>>>>>> COMMENTS >>>>>>>>>>>>
		function commentsBlock($userId, $comments, $articleId) {
			if($userId != '') {
				echo "<form action='create_comment' method='POST'>";
					echo "title: <input type='text' name='tbTitle' /> *** ";
					echo "text: <input type='text' name='tbText' /> ";
					echo "<input type='hidden' name='articleId' value='" . $articleId . "'/> ";
					echo "<input type='submit' name='btnCreateComment' value='Add comment'>";
				echo "</form>";
			}
			else {
				echo "you first must loggin to post comment.";
			}
			echo "<br/>comments:<br/>";
			foreach($comments as $row) {
				if ($row->getArticlesId()->getId() != $articleId) continue;
				if ($row->getUsersId()->getId() == $userId) {
					echo "<form class='formComment' action='update_comment' method='POST' >";
						echo "id:" . $row->getId() . " *** ";
						echo "title: <input type='text' name='tbTitle' value='".$row->getTitle()."'/> *** ";
						echo "text: <input type='text' name='tbText' value='".$row->getText()."'/> ";
						echo "text: <input type='hidden' name='articleId' value='".$row->getArticlesId()->getId()."'/> ";
						echo "text: <input type='hidden' id='commentId' name='commentId' value='".$row->getId()."'/> ";
						echo "<button type='submit' name='btnUpdateComment' value='update'>Update</button>";
						echo "<button type='submit' name='btnDeleteComment' value='delete'>Delete</button>";
					echo "</form>";
				}
				else
				{
					echo 'id: ' .$row->getId(). ' *** title: ' . $row->getTitle() . ' *** text: ' . $row->getText() . ', <br/>';
				}
			}

			echo "<br/>";
			echo "<br/>";
			echo "---------------------------------------------------------------------<br/>";
			echo "<br/>";
		}

		// <<<<<< COMMENTS <<<<<<<<

		// >>>>>> ARTICTLES >>>>>>>>
		if(isset($articles)){
			foreach($articles as $row) {
				if ($row->getUsersId()->getId() == $userId) {
					echo "<form class='form_article' name='formArticle' action='update_article' method='POST' >";
						echo "Article => id:".$row->getId()." *** ";
						echo "title: <input type='text' name='tbTitle' value='".$row->getTitle()."'/> *** ";
						echo "text: <input type='text' name='tbText' value='".$row->getText()."'/> ";
						echo "categoriesId: <input type='text' name='tbCategoriesId' value='".$row->getCategoriesId()->getId()."'/> ";
						echo "<input type='hidden' name='articleId' id='articleId' value='".$row->getId()."'>";
						echo "<button type='submit' name='btnUpdateArticle' value='update'>Update</button>";
						echo "<button type='submit' name='btnDeleteArticle' value='delete'>Delete</button>";
					echo "</form>";
					commentsBlock($userId, $comments, $row->getId());
				}
				else
				{
					echo 'Article => id: ' .$row->getId(). ' *** title: ' . $row->getTitle() . ' *** text: ' . $row->getText() . ' *** categoriesId: ' . $row->getCategoriesId()->getId().', <br/>';
					commentsBlock($userId, $comments, $row->getId());
				}
			}
		}
		// <<<<<<<< ARTICLES <<<<<<<<<<
	?>

<div class="widget">
	<p>Bài Viết Mới Nhất</p>
	<div class="tab-container ">
		<?php  
		$posts = $this->Mcontent->content_get_news(5);
		foreach ($posts as $value) :?>
			<div class="spost clearfix">
				<div class="entry-image e-img">
					<a href="tin-tuc/<?php echo $value['alias'] ?>" class="nobg a-circle">
						<img class="img-circle-custom" src="public/images/posts/<?php echo $value['img']; ?>" alt="Chương Trình Khuyến Mại Giảm Giá">
					</a>
				</div>
				<div class="entry-c">
					<div class="entry-title e-title">
						<h4>
							<a href="tin-tuc/<?php echo $value['alias'] ?>"><?php echo $value['title']; ?></a>
						</h4>
					</div>
				</div>
			</div>
		<?php endforeach; ?>
	</div>
</div>
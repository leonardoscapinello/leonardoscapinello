<section>
    <div class="blog-post">
        <div class="post-content">

            <div class="container">
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-sm-12">
                        <div class="content-blog">
                            <?php
                            $blogContent = new BlogContent();
                            echo $blogContent->getAllByPost($id);
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
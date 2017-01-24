<?php include('./include/head.php'); ?>

<body>
    
    <?php include('./include/header.php'); ?>

    <div id="page-header" class="content-contrast">
        <div class="page-title-container"  style="background:url(./img/blog-page-header-bg.jpg)" >
            <div class="background-overlay"></div>
            <div class="container centered-container">    
                <div class="centered-inner-container">
                    <h1 class="page-title">Our Blog</h1>
                </div>
            </div>
        </div>
        <div class="breadcrumb-container">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <nav class="breadcrumb">
                            <a class="breadcrumb-item" href="#">Home</a>
                            <span class="breadcrumb-item active">Blog</span>
                        </nav>                    
                    </div>
                </div>
            </div>            
        </div>
    </div>

    <div class="section">
        <div class="container">
            <div class="row">
                <div  class="col-md-1">
                </div>
                <div class="col-md-10">
                    <?php
                    include('./include/LocalDB.php');
                    $blogList = LocalDB::listAllBlogs('1');
                    foreach ($blogList as $key => $blog) {
                        # code...
                    ?>
                    <article class="post-item">
                        <div class="post-media">
                            <img src="<?=$blog['image']?>" alt="Blog Image" style="width:100%;" />  
                            <!--
                            <div class="post-type-carousel">
                                <img src="img/blog/blog-carousel1.jpg" alt="Blog Image" />                      
                                <img src="img/blog/blog-carousel2.jpg" alt="Blog Image" />                    
                                <img src="img/blog/blog-carousel3.jpg" alt="Blog Image" />  
                            </div>
                            -->
                        </div>

                        <div class="date-meta"><?=date('d', strtotime($blog['created_on']))?><span><?=date('M Y', strtotime($blog['created_on']))?></span></div>
                        
                        <div class="post-container">
                            <div class="post-header">   
                                <h3 class="post-title">
                                    <a href="single-blog.php?blog=<?=$blog['blog_id']?>"><?=$blog['title']?></a>
                                </h3>
                                <!--
                                <ul class="post-meta">
                                    <li class="author-meta"><i class="fa fa-user" aria-hidden="true"></i>By <a href="#">John Doe</a></li>
                                    <li class="comment-meta"><i class="fa fa-comment" aria-hidden="true"></i> <a href="#">3 Comments</a></li>
                                    <li class="category-meta"><i class="fa fa-tag" aria-hidden="true"></i> <a href="#">Garden</a></li>
                                </ul>
                                -->
                            </div>

                            <div class="post-content">
                                <p>
                                    <?=$blog['html_short']?>
                                </p>
                                
                                <a class="btn btn-default" href="single-blog.php?blog=<?=$blog['blog_id']?>">Read More</a>
                            </div>
                        </div>
                    </article>
                    <?php
                        }
                    ?>
                    

                    <!--
                    <article class="post-item">
                        <div class="post-media">
                            <img src="img/blog/blog-carousel3.jpg" alt="Blog Image" />  
                        </div>

                        <div class="date-meta">27<span>May 2016</span></div>
                        
                        <div class="post-container">
                            <div class="post-header">   
                                <h3 class="post-title">
                                    <a href="single-post.html">Spring Tree bloom Detail is Wonderful</a>
                                </h3>
                            </div>
                            <div class="post-content">
                                <p>
                                    Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat adipisci velit, sed quia non numquam eius modi tempora incidunt soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus voluptas assumenda voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt neque porro quisquam est, qui dolorem ipsum quia dolor sit amet.
                                </p>
                                <a class="btn btn-default" href="single-post.html">Read More</a>
                            </div>
                        </div>
                    </article>
                    -->
                    
                    <!-- pagination -->
                    <!--
                    <div class="pagination-container text-center">  
                        <ul class="pagination">
                            <li class="page-item disabled">
                                <a class="page-link" href="#" aria-label="Previous">
                                    <i class="fa fa-angle-double-left" aria-hidden="true"></i>
                                </a>
                            </li>
                            <li class="page-item active">
                                <a class="page-link" href="#">1 <span class="sr-only">(current)</span></a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#" aria-label="Next">
                                    <i class="fa fa-angle-double-right" aria-hidden="true"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                    -->
                    <!-- pagination -->
                </div>

                <div  class="col-md-1">
                </div>
            </div>
        </div>
    </div>    
    
    <?php include('include/footer.php'); ?>

    <?php include('include/footer_script.php'); ?>


</body>

<!-- Mirrored from themedemo.foundstrap.com/zengarden/blog.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 17 Jan 2017 18:33:14 GMT -->
</html>
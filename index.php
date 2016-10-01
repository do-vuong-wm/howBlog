<?php
/**
 * Created by PhpStorm.
 * User: session2
 * Date: 9/27/16
 * Time: 4:23 PM
 */
require 'essentials/includes.php';

$database = new Database;

$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

if(@$_POST['delete']){

    $form_id = $_POST['form_id'];
    $database->query('DELETE FROM posts WHERE id = :id');
    $database->bind(':id', $form_id);
    $database->execute();


}

if(@$post['update']){

    $id = $post['id'];
    $newtitle = $post['title'];
    $newbody = $post['body'];

    $database->query('UPDATE posts SET title = :title , body = :body WHERE id = :id');
    $database->bind(':title', $newtitle);
    $database->bind(':body', $newbody);
    $database->bind(':id', $id);
    $database->execute();

}

if(@$post['submit']){
    $title = $post['title'];
    $body = $post['body'];



    $database->query('INSERT INTO posts (title, body) VALUES(:title, :body)');
    $database->bind(':title', $title);
    $database->bind(':body', $body);
    $database->execute();
    if($database->lastInsertId()){
        echo '<p>Post Added!</p>';
    }
}

?>

<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>howBlog - Learn how to do things</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="essentials/styles.css">

</head>
<body style="height: 1900px;">

<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <p></p>
        </div>
        <div class="collapse navbar-collapse">
            <form class="navbar-form navbar-right" id="form">
                <div class="form-group">
                    <span>Username </span>
                    <input class="form-control" type="text" name="username" placeholder=" ">
                    <span>Password </span>
                    <input class="form-control" type="password" name="password" placeholder=" ">
                </div>
                <button class="btn btn-info" type="submit" name="submit">Submit</button>
            </form>
            <ul class="nav navbar-nav navbar-right">
                <li class="active">
                    <a href="#home">Home</a>
                </li>
                <li id="login"><a href="#"
                                  onclick="document.getElementById('form').style.display = 'block'; document.getElementById('login').style.display = 'none';">Login</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="row">
    <div class="title-box">
        <div class="jumbotron">
            <div class="container">
                <div class="row">
                    <div class="col-xs-4 col-xs-offset-8">
                        <h1 style="color: white;">howBlog</h1>
                        <p style="color: white;">A how to blog on how to do something</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row row-content">
        <ul class="col-xs-12">
            <div class="row">
                <div class="col-xs-12">
                    <div class="media">
                        <a href="#"><img class="media-object"
                                         src="https://tctechcrunch2011.files.wordpress.com/2015/04/codecode.jpg"
                                         alt="codepic" style="width: 100%; height: 200px;"></a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="media-body">
                            <div class="row">
                                <div class="col-xs-4">
                            <h2 class="media-heading media-left">How to code</h2>
                                    <ul>
                                        <li>
                                            Likes
                                            <span class="badge likes"> 15</span>
                                        </li>
                                        <li>
                                            Shared
                                            <span class="badge shared"> 2</span>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-xs-8">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer tempor ipsum non nisl
                                tempor,
                                vel posuere dolor imperdiet. Donec quis efficitur leo. Nam at faucibus mi, sed imperdiet
                                mauris.
                                Donec fermentum ipsum eu purus bibendum, nec placerat arcu laoreet. Pellentesque
                                molestie et
                                quam et ullamcorper. Cum sociis natoque penatibus et magnis dis parturient montes,
                                nascetur
                                ridiculus mus. Donec ullamcorper, augue vel pellentesque viverra, risus erat finibus
                                magna,
                                vitae scelerisque dolor odio imperdiet risus. Vestibulum bibendum lobortis egestas. Duis
                                commodo
                                aliquet quam, ut sollicitudin urna. Pellentesque vestibulum blandit volutpat.

                                <a href="#">Read More...</a>

                            </p>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
</div>
<hr>
</div>

<!-- Jquery -->

<script src="https://code.jquery.com/jquery-3.1.1.min.js"
        integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
        crossorigin="anonymous"></script>
</body>
</html>

CREATE TABLE `blog_post_tags` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`blog_id` int(11) NOT NULL,
`tag_id` int(11) NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `blogs` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`title` text NOT NULL,
`body` text NOT NULL,
`author_id` int(11) NOT NULL,
`createdate` date NOT NULL,
`url` varchar(255) DEFAULT NULL,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `peoples` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`name` varchar(255) NOT NULL,
`email` varchar(255) DEFAULT NULL,
`joindate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `tags` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`name` varchar(255) NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


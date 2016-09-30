# howBlog
Object Oriented Programming in PHP Final Project

This assessment will focus on all of the goals we have reached in our instruction and learning with regard to object oriented programming in PHP.

Please review your previous practical assessments if you have any questions about what topics/strategies can be included.

The project you are about to build is based on the lessons we have learned. You will build a blog platform for a client who is just getting started in the business. They have very little idea as to what they want, but you… the confident web-designer… are understanding and are willing to work patiently with your client. However, the clock is ticking and you do not have time to waste, as you have other deadlines for other projects.

Please follow each of the instructions very carefully. This will get your blogging platform’s backend built. You will then be responsible for designing the finished front-end product as your deliverable. It must be simple and neat and must function according to the guidelines below.

Instructions
Part 1) Creating our Database

Before you move into MySQL Workbench or your IDE and start creating your tables, or objects, we should lay out what you want in your blog. The obvious thing you need to hold is blog posts, and in each post it should contain a title, the post, an author, and the date it was posted. This can be accomplished using pen and paper, notecards or by drawing a diagram using Lucidchart. As with previous assignments, you will need to submit this for grading as well.
You could just make one table to hold that information, and most likely accomplish creating a basic blog, but with just one table you will not have as much control over the data. For example, you could just store the name of the author in the same table as the blog post, but what if your client wants to also store the author's email? Adding another field to our table would be the obvious solution.
Make a separate table called "People" and in this, you will store all the information you need from the author - such as emails, URLs, their name, and a unique ID. Then in your blog post table you will point to the person you want using that person's unique ID. This id is referred to as a foreign key and the relationship between the blog post table and the people table is called a one-to-many relationship.
You will also want to have a tag for each blog post. Again you want to make the database efficient so you will create a separate table for your tags.
Create a field in the blog post table that is a foreign key for your tag and use a one-to-many relationship. To do this you need to create another table that will be called: "blog_post_tags" that will hold two foreign keys, one will be the blog post's ID and the other will be the tag ID that the blog post is associated with.
This way you can assign as many tags as you want to a blog post but can still edit the information about that specific tag across all posts with a simple MySQL query.
Now that you have outlined what you want your database to look like, let's create it. Use MySQL Workbench to create your schemas and tables.
There are a few different naming conventions you can use when creating your database, table, and field names. Please use all lowercase and underscores in place of spaces.
Create our database, name it something practical which applies to this project.

Next, create your tables; the first will be "blog_posts".
"blog_posts" will have five fields: "id", "title", "post", "author_id", and "date_posted". For "id" you will make it the primary key and set it to auto-increment. What this will do is generate your unique id. Each time you add a post it will give it a number starting at one and moving up for as many posts as you have.
You also need to set the variable type for each field. The id will be set to type int, short for integer, since it can only be a number and we will set the max length to 11.
The field "title" will be set to type varchar with a max length of 255. The "post" field will be type "text" and you will not set a max length since posts can be very long. "author_id" will be the same as "id" but you will not set it as your primary key or have it auto increment, and you will set "date_posted" to type "Date".
Note: This image is just an example of what it should resemble.


Your next table will be "people". You should not call it "authors" because down the road you might want to create the ability to register and post comments and those people would not be considered authors.
"people" will contain five fields also: "id", "first_name", "last_name", "url", and "email".
"id" will be set as an int, the primary key, and to auto increment, the same way you set id of "blog_posts". "first_name", "last_name", "url", and "email" will all be set to type varchar with a max length of 255.
Your next table will be "tags" and will for now contain only two fields: "id" and "name". Later, you could make this more complex by adding a description but for a passing grade, you do not have to. As you did before "id" will be set as int, the primary key, and to auto increment. "name" will be type varchar and have a max length of 255.
Your last table, "blog_post_tags", will have only two fields: "blog_post_id" and "tag_id". They will both be set to type int with a max length of 11. Do not set a primary key for this table. This is because you will never be getting data out of this table unless you ask for a specific blog post or all posts of a specific tag id.
Part 2) Creating Objects in PHP

Prior to writing any code, you will need to plan out exactly which objects/properties/methods you will be using. Use pencil and paper or Lucidchart. This will be a significant portion of your grade.

Before you start compiling your actual PHP code you need to create your files and folders. For this assignment, you will have your index.php in your root folder, then an includes folder that will hold your CSS stylesheet, your JavaScript files (includes.php) that will hold references to your objects and MySQL connection, and blogpost.php that will hold your BlogPost object.
Now that you have your database set, you need to create the objects in PHP that will handle the data. Objects in programming are a way to pull together different attributes (as variables) and methods that all relate to the same thing. Objects also help us organize our programs much more.
You will only need one object for now called "BlogPost". BlogPost will have six properties, id, title, post, author, tags, and date posted.
To define an object in PHP you define it as a "class". A class is the structure of each object, or as wikipedia describes it, "In object-oriented programming, a class is a programming language construct that is used as a blueprint to create objects. This blueprint includes attributes and methods that the created objects all share." (http://en.wikipedia.org/wiki/Concrete_class).
Open up your blogpost.php page and define your first object.

In your class we need first define our properties. To do this, we have to create variables - but with "public" in front of them. Just a quick note, if you are using PHP4 then you will need to use "var" instead of "public".
Now that you have all your properties defined, you want to define your first method. Methods are also described as functions, but the main difference is that a method is a function inside an object. So all methods are also functions but not all functions are methods.
The first method will be what is called a constructor; this method is automatically called whenever you make a new instance of the BlogPost object.
Create a new function called __construct() and pass in five values: id, title, post, author id, and date posted. For each variable name you are going to put "in" before the word so you can tell inside your functions what variables are being passed in and what variables are already present.
The problem here is that, with this current code, every time you create a new instance of BlogPost you need to supply all those properties. If you want to make a new blog post and have yet to define those variables you will need to "overload" the arguments for your function so that if you call the function and don't pass in one of the arguments, it will automatically set it to the default value.
This is an example of what you might use.
function __construct($inId=null, $inTitle=null, $inPost=null, $inPostFull=null, $inAuthorId=null, $inDatePosted=null)
{
}
Set each argument to the value "null". Inside your constructor, you need to set each of your variables to your passed in values. To do this you want to set them to the object you are in right now; You can do this with the "this" keyword. Unlike many other languages to access a property in PHP you use "->" where in most languages (I.E. JavaScript, ASP.NET) you use ".".
This works for id, title, and post. But what about our other ones? For date you are going to need to reformat the data you got from MySQL to be more readable. That's easily accomplished; you just explode it (also known as splitting in other programming languages) and then put it back together. MySQL gives it to you in this format yyyy-mm-dd, so if you explode it using "-" as your separator you will get an array holding three values. The first will hold the year, the next will hold the month, and the last will be the day.
Put them back together using this format: mm/dd/yyyy.
For the author, all we have to do is ask the database for the person with the id of our author ID. We can do this with a basic MySQL query.
Left Join
Now the tags will be slightly more difficult. You are going to need to talk to the database, so you need to create a query. Don't worry about the database connection right now, that will be defined outside of this class. Now, all you have is the blog post's ID. You can compare that to the blog posts tags in our blog_post_tags table but then we will only get back the tag's ID and will need to do another query to get the information about the tag. That's no good; We want to be efficient so let's do it in just one query!
To do this you will need to create  a left join, this means you are going to also select data from another table but only when it matches the data from the "left," or your other selected data. First get all tag IDs that are associated with your blog post's ID in the blog_post_tags table.
Add your left join and tell your query you only want the data in the tags table:
Now the query is selecting all from the tags and blog_posts_tags tables where, first blog_post_tags.blog_post_id equals the one we provided and then also returns the information about each tag that has that tag_id that is in the same row of data as our blog_post_id.
Process that data in PHP with a simple while loop. Create two arrays that will hold your data: one for the tag name, and the other for the tag id. You will also make a string to hold all of your tags. You will first set this to "No Tags" so that if you return no data from your MySQL query, it will return that you have no tags, otherwise that value will be overwritten with the tag names.
Check to make sure if the array has a length greater than zero (you don't want to perform all of this extra code if you don't have to). Next, for each tag in your tag name array, you are going to concatenate a string of tags. You will use a simple if else statement.
You most likely noticed that we did not use the tag id arrays. We are going to leave those alone for now and come back to them later. We just want to get our blog up and running first.
The last step for your class is to add if statements for each property so that if you pass in nothing, it will not try to set the current object's property to nothing (this will cause an error). Here is the entire BlogPost class with the if statements added:
Now that your object class is complete, most of the hard stuff is done! Now all you have to do is set up your database connection and the HTML to display your posts!

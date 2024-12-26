<?php
if (!isset($_SESSION['go'])) {

$errors = [];
// 0. Token
 

// 1. Name - required, alphabets and spaces only

if(!empty($_POST['name'])) {
    $name = $_POST['name'];
    if(ctype_alpha(str_replace(" ", "", $name)) === false) {
        $errors[] = "Name should contain only alphabets and spaces";
    }
}
else {
    $errors[] = "Name field cannot be empty";
}

// 2. Email - required, validate using filter_var() function

if(!empty($_POST['email'])) {
    $email = $_POST['email'];
    if(filter_var($email, FILTER_VALIDATE_EMAIL) !== $email) {
        $errors[] = "Email is not valid";
    }
    
}
else {
    $errors[] = "Email can't be empty";
}

// 3. Region - required, value should be from the list

if(!empty($_POST['region'])) {
    $region = $_POST['region'];
    $allowed_regions = ["Asia", "Oceania", "Africa", "Europe", "North America", "Latin America"];
    if(!in_array($region, $allowed_regions)) {
        $errors[] = "Region not in list";
    }
}
else {
    $errors[] = "Select a region from the list";
}

// 4. Season - not required, but must be in the list if selected

if(!empty($_POST['season'])) {
    $season = $_POST['season'];
    $allowed_seasons = ["Summer", "Winter", "Spring", "Autumn", "Monsoon"];
    if(!in_array($season, $allowed_seasons)) {
        $errors[] = "Invalid Season";
    }
}

// 5. Interests - not required, but must be in the list if selected

if(!empty($_POST['interests'])) {
    $interests = $_POST['interests']; // this is also array
    $interests_allowed = ["Photography", "Trekking", "Star Gazing", "Bird Watching", "Camping"];

    foreach($interests as $interest) {
        if(!in_array($interest, $interests_allowed)) {
            $errors[] = "The activity you selected is not in our list";
            break;
        }
    }

}

// 6. Participants - required, must be between 1 and 10

if(!empty($_POST['participants'])) {
    $participants = (int)$_POST['participants'];
    if($participants < 1 || $participants > 10) {
        $errors[] = "No. of participants must be 1-10";
    }
}
else {
    $errors[] = "Specify the no. of participants";
}

// 7. Message - required, no html tags, js code, etc, just normal text

if(!empty($_POST['message'])) {
    // $message = htmlentities($_POST['message'], ENT_QUOTES, "UTF-8");
    // this is escaping, we'll do it while outputting
    $message = $_POST['message'];
}
else {
    $errors[] = "Tell about your requirements";
}

 
    
    
}
else {

    $data = [
     
        "name" => $name,
        "email" => $email,
        "region" => $region,
        "season" => $season,
        "interests" => implode(", ", $interests),
        "participants" => $participants,
        "message" => $message
    ];
    }

 
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ABC Tours & Travels</title>
    <link rel="stylesheet" href="style.css">
</head>
<style>
html, body, ul, p, div, span, img, form, h1, h2, h3, h4, h5, h6 {
    margin: 0;
    padding: 0;
}

.container {
    max-width: 720px;
    margin: 0 auto;
}
h1 {
    padding: .8em 0;
    margin-bottom: .8em;
    border-bottom: 1px solid #dcdcdc;
}
input[type="text"],
input[type="email"],
input[type="number"],
select,
textarea {
    display: block;
    width: 100%;
    padding: .5em;
}
button[type="submit"] {
    display: block;
    padding: 1em 3em;
    background: rgb(110, 105, 245);
    border: none;
    color: white;
    cursor: pointer;
}
.field-title {
    display: block;
    font-weight: bold;
    margin-bottom: .5em;
}
textarea {
    min-height: 10vh;
}
.field-group {
    display: block;
    margin-bottom: 1.25em;
}

ul.errors {
    padding: 1em;
    margin-bottom: 1.25em;
    background:rgba(247, 112, 94, .2);
    border: 1px solid rgba(247, 112, 94, .5);
    list-style-position: inside;
    border-radius: 3px;
}
.success {
    padding: 1em;
    margin-bottom: 1.25em;
    background:rgba(143, 247, 94, 0.2);
    border: 1px solid rgba(143, 247, 94, .5);
    border-radius: 3px;
}
.success ul {
    list-style-position: inside;
    margin-top: .5em;
}
em {
    font-weight: bold;
}
.ideas {
    margin: .5em 0;
}
.ideas h2 {
    font-size: 1.15em;
}
.ideas h3 {
    font-size: 1.125em;
}
.ideas ul {
    list-style: none;
    margin: .5em 0;
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    column-gap: 5px;
}
.ideas ul li img {
    display: block;
    max-width: 100%;
}
</style>
<body>
    <div class="container">
        <h1>Find Tours</h1>
         
    
        <form action="" method="post">
            <div class="field-group">
                <label for="name" class="field-title">First Name:</label>
                <input type="text" name="name" id="name" placeholder="Enter your name">
            </div>
            <div class="field-group">
                <label for="email" class="field-title">Email:</label>
                <input type="email" name="email" id="email" placeholder="Enter email for contact">
            </div>
            <div class="field-group">
                <label for="region" class="field-title">Where would you like to go?</label>
                <select name="region" id="region">
                    <option value="">--Select a Region--</option>
                    <option value="Asia">Asia</option>
                    <option value="Oceania">Oceania</option>
                    <option value="Africa">Africa</option>
                    <option value="Europe">Europe</option>
                    <option value="North America">North America</option>
                    <option value="Latin America">Latin America</option>
                </select>
            </div>
            <div class="field-group">
                <p class="field-title">Preferred seaons:</p>
                <input type="radio" name="season" id="summer" value="Summer">
                <label for="summer">Summer</label>

                <input type="radio" name="season" id="winter" value="Winter">
                <label for="winter">Winter</label>

                <input type="radio" name="season" id="spring" value="Spring">
                <label for="spring">Spring</label>

                <input type="radio" name="season" id="autumn" value="Autumn">
                <label for="autumn">Autumn</label>

                <input type="radio" name="season" id="monsoon" value="Monsoon">
                <label for="monsoon">Monsoon</label>
            </div>
            <div class="field-group">
                <p class="field-title">Your interests:</p>
                <input type="checkbox" name="interests[]" id="photography" value="Photography">
                <label for="photography">Photography</label>

                <input type="checkbox" name="interests[]" id="trekking" value="Trekking">
                <label for="trekking">Trekking</label>

                <input type="checkbox" name="interests[]" id="star-gazing" value="Star Gazing">
                <label for="star-gazing">Star Gazing</label>

                <input type="checkbox" name="interests[]" id="bird-watching" value="Bird Watching">
                <label for="bird-watching">Bird Watching</label>

                <input type="checkbox" name="interests[]" id="camping" value="Camping">
                <label for="camping">Camping</label>
            </div>
            <div class="field-group">
    <label for="participants" class="field-title">Number of participants:</label>
    <input type="number" name="participants" id="participants" placeholder="Enter number of participants" min="1" max="10">
</div>
<div class="field-group">
    <label for="message" class="field-title">Your message:</label>
    <textarea name="message" id="message" placeholder="Describe your requirements"></textarea>
</div>


             
                 
                <button type="submit" name="go">Send</button>
            </div>
         
        </form>
        
        <ul class="errors">
            <?php foreach($errors as $e) : ?>
                <li><?= $e ?></li>
            <?php endforeach; ?>
        </ul>
        
         <ul class="errors">
            <?php foreach($data as $e) : ?>
                <li><?= $e ?></li>
            <?php endforeach; ?>
        </ul>
        
        
        
    </div>
    
</body>
</html>



 

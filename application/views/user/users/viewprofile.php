<h3>CONTACT</h3>
<p>Name: <?php echo $name;?>
<p>Email: <?php echo $email;?>
<p>Phone: <?php echo $phone;?>


<p>Graduation Year: <?php if(isset($gradyear)) echo $gradyear;?>
<p>Bio: <?php if(isset($bio)) echo $bio;?>
<p>Interests: <?php if(isset($interests)) echo $interests;?>
<p>Skills: <?php if(isset($skills)) echo $skills;?>
<?php if(isset($linkedin)) echo "<p><a href=\"$linkedin\">LinkedIn</a>";?>
<?php if(isset($linkedin)) echo "<p><a href=\"$resume\">Link to resume</a>";?>
<p>Additional Info: <?php if(isset($additional)) echo $additional;?>



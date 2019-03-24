<?php /* Template Name: Subscribe */ 
 get_header();
?>
 <div class="container mt-2 mb-3">
    <div class="form-row">
        <!--NAME-->
        <div class="col-sm">
            <div class="fom-group">
                <legend for="name">Name:</legend>
                <input type="text" class="form-control" id="name" name="name" required >
            </div>
        </div>
        <!--EMAIL-->
        <div class="col-sm">
            <div class="fom-group">
                <legend for="email">Email:</legend>
                <input type="email" class="form-control" id="email" name="email" required >
            </div>
        </div>
    </div>
 </div>
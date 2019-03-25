<?php /* Template Name: Subscribe */ 
 get_header();
?>
 <div class="container mt-5 mb-5">
    <form id="subscForm"> 
        <div class="form-row">
            <!--NAME-->
            <div class="col-sm mb-2">
                <div class="fom-group">
                    <legend for="subs_name">Name:</legend>
                    <input type="text" class="form-control required" id="subs_name" name="subs_name" placeholder="Enter full name"  >
                </div>
            </div>
            <!--EMAIL-->
            <div class="col-sm mb-2">
                <div class="fom-group">
                    <legend for="email">Email:</legend>
                    <input type="email" class="form-control required" id="email" name="email" placeholder="Enter email" >
                </div>
            </div>

            <div class="w-100"></div>

            <div class="col-sm mb-3">
                <input type="submit" class="btn btn-block btn-success" id="Subscribe">
            </div>

        </div>
    </div>
 </div>
<?php /* Template Name: Subscribe */ 
 get_header();
?>
 <div class="container mt-5 mb-5">
    <div class="row h-100 align-items-center">
        <div class="col-sm col-centered">
            <form id="subscForm" class="um-form"> 
                <div class="form-row align-items-center">
                    <!--NAME-->
                    <div class="col-sm mb-2">
                        <div class="fom-group">
                            <legend for="subs_name">Name:</legend>
                            <input type="text" class="form-control required" id="subs_name" name="subs_name" placeholder="Enter full name"  >
                        </div>
                    </div>
                    <div class="w-100"></div>
                    <!--EMAIL-->
                    <div class="col-sm mb-2">
                        <div class="fom-group">
                            <legend for="email">Email:</legend>
                            <input type="email" class="form-control required" id="email" name="email" placeholder="Enter email" >
                        </div>
                    </div>

                    <div class="w-100"></div>

                    <div class="col-sm mb-3">
                        <input type="submit" class="btn btn-block btn-subscribe" id="Subscribe">
                    </div>

                </div>    
            </form>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.row -->
 </div>
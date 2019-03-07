<div class="container p-3 mt-5" id="reviewForm">
    <form>
        <!-- 1st row starts -->
        <div class="row">

            <!-- Bike Brand -->
            <div class="col-sm">
                <div class="form-group">
                    <label for="bikeBrand">Bike Brand</label>
                    <input type="text" class="form-control is-invalid" id="bikeBrand" aria-describedby="brandHelp" placeholder="Enter bike brand">
                    <small id="brandHelp" class="invalid-feedback">Bike brand is required.</small>
                </div>
            </div>

            <!-- Bike Model -->
            <div class="col-sm">
                <div class="form-group">
                    <label for="bikeModel">Bike Model</label>
                    <input type="text" class="form-control is-invalid" id="bikeModel" aria-describedby="modelHelp" placeholder="Enter bike model">
                    <small id="modelHelp" class="invalid-feedback">Bike model is required.</small>
                </div>
            </div>

            <!-- Bike Category -->
            <div class="col-sm">
                <div class="form-group">
                    <label for="bikeCategory">Category</label>
                    <select class="form-control" id="bikeCategory">
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                    </select>
                </div>
            </div>

            <!-- Bike Price -->
            <div class="col-sm">
                <div class="form-group">
                    <label for="bikePrice">Bike Price</label>
                    <input type="number" class="form-control is-invalid" id="bikePrice" aria-describedby="priceHelp" placeholder="Enter bike price ($)">
                    <small id="priceHelp" class="invalid-feedback">Bike price is required.</small>
                </div>
            </div>

        </div>
        <!-- 1st row ends -->


        <!-- 2nd row starts -->
        <div class="row">
            <div class="col-sm">
                <label for="customRange1">Was it right bike for you ?</label>                
            </div>
            <div class="w-100">
            <div class="col-sm">
             <input type="range" class="custom-range w-100" id="customRange1" min="0" max="10">
            </div>
        </div>
        <!-- 2nd row starts -->

        <!-- 3rd row starts -->
        <div class="row w-100 mt-3 pl-2">
            
            <div class="col-sm">
                <div class="form-group">
                    <label for="positiveFeedback1">1st Positive</label>
                    <input type="text" class="form-control" id="positiveFeedback1" aria-describedby="feedback1" placeholder="Enter 1st positive feedback">
                    <small id="feedback1" class="form-text text-muted">tell us what you have found positive in this bike.</small>
                </div>
            </div>

            <div class="col-sm">
                <div class="form-group">
                    <label for="positiveFeedback2">2nd Positive</label>
                    <input type="text" class="form-control" id="positiveFeedback2" aria-describedby="feedback2" placeholder="Enter 2nd positive feedback">
                    <small id="feedback2" class="form-text text-muted">tell us what you have found positive in this bike.</small>
                </div>
            </div>

            <div class="col-sm">
                <div class="form-group">
                    <label for="positiveFeedback3">3rd Positive</label>
                    <input type="text" class="form-control" id="positiveFeedback3" aria-describedby="feedback3" placeholder="Enter 2nd positive feedback">
                    <small id="feedback3" class="form-text text-muted">tell us what you have found positive in this bike.</small>
                </div>
            </div>

        </div>
         <!-- 3rd row ends -->

         <!-- 4th row starts -->
        <div class="row w-100 mt-3 pl-2">
            
            <div class="col-sm">
                <div class="form-group">
                    <label for="positiveFeedback1">1st Negative</label>
                    <input type="text" class="form-control" id="positiveFeedback1" aria-describedby="feedback1" placeholder="Enter 1st positive feedback">
                    <small id="feedback1" class="form-text text-muted">tell us what you have found negative in this bike.</small>
                </div>
            </div>

            <div class="col-sm">
                <div class="form-group">
                    <label for="positiveFeedback2">2nd Negative</label>
                    <input type="text" class="form-control" id="positiveFeedback2" aria-describedby="feedback2" placeholder="Enter 2nd positive feedback">
                    <small id="feedback2" class="form-text text-muted">tell us what you have found negative in this bike.</small>
                </div>
            </div>

            <div class="col-sm">
                <div class="form-group">
                    <label for="positiveFeedback3">3rd Negative</label>
                    <input type="text" class="form-control" id="positiveFeedback3" aria-describedby="feedback3" placeholder="Enter 2nd positive feedback">
                    <small id="feedback3" class="form-text text-muted">tell us what you have found negative in this bike.</small>
                </div>
            </div>

        </div>
         <!-- 4th row ends -->

        <!-- 5th row starts -->
        <div class="row w-100 mt-3 pl-2">
            <div class="col-sm">
                <label for="customRange1">Rate this bike against these categories:</label>                
            </div>            
        </div>
        <!-- 5th row ends -->

        <!-- 6th row starts -->
        <div class="row w-100 m-2">

            <div class="col-sm text-center border-bottom border-dark mr-1">
              <label for="positiveFeedback3">Value for money:</label>
            </div>
            
            <div class="col-sm rating-stars border-bottom border-dark ml-1">
              <i class="fa fa-star fa-fw"></i>
              <i class="fa fa-star fa-fw"></i>
              <i class="fa fa-star fa-fw"></i>
              <i class="fa fa-star fa-fw"></i>
              <i class="fa fa-star fa-fw"></i>
            </div>            

        </div>
        <!-- 6th row ends -->

        <!-- 7th row starts -->
        <div class="row w-100 m-2">
            <div class="col-sm text-center border-bottom border-dark mr-1">
              <label for="positiveFeedback3">Frame:</label>
            </div>
            
            <div class="col-sm rating-stars border-bottom border-dark ml-1">
              <i class="fa fa-star fa-fw"></i>
              <i class="fa fa-star fa-fw"></i>
              <i class="fa fa-star fa-fw"></i>
              <i class="fa fa-star fa-fw"></i>
              <i class="fa fa-star fa-fw"></i>
            </div>

        </div>
        <!-- 7th row ends -->

        <!-- 8th row starts -->
        <div class="row w-100 m-2">
            <div class="col-sm text-center border-bottom border-dark mr-1">
              <label for="positiveFeedback3">Comfort:</label>
            </div>
            
            <div class="col-sm rating-stars border-bottom border-dark ml-1">
              <i class="fa fa-star fa-fw"></i>
              <i class="fa fa-star fa-fw"></i>
              <i class="fa fa-star fa-fw"></i>
              <i class="fa fa-star fa-fw"></i>
              <i class="fa fa-star fa-fw"></i>
            </div>

        </div>
        <!-- 8th row ends -->

        <!-- 9th row starts -->
        <div class="row w-100 m-2">
            <div class="col-sm text-center border-bottom border-dark mr-1">
              <label for="positiveFeedback3">Design:</label>
            </div>
            
            <div class="col-sm rating-stars border-bottom border-dark ml-1">
              <i class="fa fa-star fa-fw"></i>
              <i class="fa fa-star fa-fw"></i>
              <i class="fa fa-star fa-fw"></i>
              <i class="fa fa-star fa-fw"></i>
              <i class="fa fa-star fa-fw"></i>
            </div>

        </div>
        <!-- 9th row ends -->

        <!-- 10th row starts -->
        <div class="row w-100 m-2">
            <div class="col-sm text-center border-bottom border-dark mr-1">
              <label for="positiveFeedback3">Gearing:</label>
            </div>
            
            <div class="col-sm rating-stars border-bottom border-dark ml-1">
              <i class="fa fa-star fa-fw"></i>
              <i class="fa fa-star fa-fw"></i>
              <i class="fa fa-star fa-fw"></i>
              <i class="fa fa-star fa-fw"></i>
              <i class="fa fa-star fa-fw"></i>
            </div>

        </div>
        <!-- 10th row ends -->

        <!-- 11th row starts -->
        <div class="row w-100 m-2">
            <div class="col-sm text-center border-bottom border-dark mr-1">
              <label for="positiveFeedback3">Brakes:</label>
            </div>
            
            <div class="col-sm rating-stars border-bottom border-dark ml-1">
              <i class="fa fa-star fa-fw"></i>
              <i class="fa fa-star fa-fw"></i>
              <i class="fa fa-star fa-fw"></i>
              <i class="fa fa-star fa-fw"></i>
              <i class="fa fa-star fa-fw"></i>
            </div>

        </div>
        <!-- 11th row ends -->

        <!-- 12th row starts -->
        <div class="row w-100 m-2">
            <div class="col-sm text-center border-bottom border-dark mr-1">
              <label for="positiveFeedback3">Breaks:</label>
            </div>
            
            <div class="col-sm rating-stars border-bottom border-dark ml-1">
              <i class="fa fa-star fa-fw"></i>
              <i class="fa fa-star fa-fw"></i>
              <i class="fa fa-star fa-fw"></i>
              <i class="fa fa-star fa-fw"></i>
              <i class="fa fa-star fa-fw"></i>
            </div>

        </div>
        <!-- 12th row ends -->

        <!-- 13th row starts -->
        <div class="row w-100 m-2">
            <div class="col-sm text-center border-bottom border-dark mr-1">
              <label for="positiveFeedback3">Steering:</label>
            </div>
            
            <div class="col-sm rating-stars border-bottom border-dark ml-1">
              <i class="fa fa-star fa-fw"></i>
              <i class="fa fa-star fa-fw"></i>
              <i class="fa fa-star fa-fw"></i>
              <i class="fa fa-star fa-fw"></i>
              <i class="fa fa-star fa-fw"></i>
            </div>

        </div>
        <!-- 13th row ends -->

        <!-- 14th row starts -->
        <div class="row w-100 m-2">
            <div class="col-sm text-center border-bottom border-dark mr-1">
              <label for="positiveFeedback3">Wheels:</label>
            </div>
            
            <div class="col-sm rating-stars border-bottom border-dark ml-1">
              <i class="fa fa-star fa-fw"></i>
              <i class="fa fa-star fa-fw"></i>
              <i class="fa fa-star fa-fw"></i>
              <i class="fa fa-star fa-fw"></i>
              <i class="fa fa-star fa-fw"></i>
            </div>

        </div>
        <!-- 14th row ends -->

        <!-- 15th row starts -->
        <div class="row w-100 m-2">
            <div class="col-sm text-center border-bottom border-dark mr-1">
              <label for="positiveFeedback3">Saddle:</label>
            </div>
            
            <div class="col-sm rating-stars border-bottom border-dark ml-1">
              <i class="fa fa-star fa-fw"></i>
              <i class="fa fa-star fa-fw"></i>
              <i class="fa fa-star fa-fw"></i>
              <i class="fa fa-star fa-fw"></i>
              <i class="fa fa-star fa-fw"></i>
            </div>

        </div>
        <!-- 15th row ends -->

        <!-- 16th row starts-->
        <div class="row w-100 m-1">
            <div class="col-sm">
                <div class="form-group">
                    <label for="country">Country</label>
                    <select class="form-control" id="country">
                        <option>Afghanistan</option>
                        <option>Pakistan</option>
                        <option>Iran</option>
                        <option>India</option>
                        <option>China</option>
                    </select>
                </div>
            </div>
        </div>
        <!-- 16th row ends-->

        <!-- 17th row starts-->
        <div class="row w-100 m-2">
            <div class="col-sm">
                <div class="form-group">
                    <label class="custom-file-label" for="videoFile">Upload video</label>
                    <input type="file" class="custom-file-input" id="reviewVideo" aria-describedby="videoHelp" placeholder="Enter bike brand">
                    
                    <video class="img-fluid" id="reviewVideo" playsinline="playsinline" autoplay="autoplay" muted="muted" loop="loop">
                        <source src="https://storage.googleapis.com/coverr-main/mp4/Mt_Baker.mp4" type="video/mp4">
                    </video>
                    <small id="videoHelp" class="form-text text-muted">Your review must not be longer than 90 seconds. You must cover the following points in this order:
                        <span>
                            <ul>
                                <li>What I like</li>
                                <li>What I don't like</li>
                                <li>Standouts</li>
                                <li>Who should buy it</li>
                                <li>Who should avoid it</li>
                            </ul>
                        </span>
                    </small>
                </div>

            </div>
        </div>
        <!-- 17th row ends-->

        <!-- 18th row starts -->
        <div class="row w-100 m-2">

            <div class="col-sm mr-1">
                <div class="form-group">
                    <label class="custom-file-label" for="Image1">Bike Image</label>
                    <input type="file" class="custom-file-input" id="Image1" imageNum="1">
                    <img class="img-fluid" id='image-1'/>
                </div>
            </div>
        </div>
        <!-- 18th row ends -->

        <!-- 19th row ends -->
        <div class="row w-100 m-2">
            <div class="form-group col-sm">
                <label class="custom-file-label" for="Image2">Gears Image</label>
                <input type="file" class="custom-file-input" id="Image2" imageNum="2">
                <img class="img-fluid" id='image-2'/>
            </div>           
           
            <div class="form-group col-sm">
                <label class="custom-file-label" for="Image3">Tyres Image</label>
                <input type="file" class="custom-file-input" id="Image3" imageNum="3">
                <img class="img-fluid" id='image-3'/>
            </div>
        </div>
        <!-- 19th row ends -->

        <!-- 20th row ends -->
        <div class="row w-100 m-2">
        
            <div class="form-group col-sm">
                <label class="custom-file-label" for="Image4">Handlebar Image</label>
                <input type="file" class="custom-file-input" id="Image4" imageNum="4">
                <img class="img-fluid" id='image-4'/>
            </div>

        
            <div class="form-group col-sm">
                <label class="custom-file-label" for="Image5">Suspension Image</label>
                <input type="file" class="custom-file-input" id="Image5" imageNum="5">
                <img class="img-fluid" id='image-5'/>
            </div>

        </div>
        <!-- 20th row ends -->

        <!-- 21th row starts -->
        <div class="row w-100 m-2">
        <!-- Name -->
        <div class="form-group col-sm">
            <label for="inputEmail4">Name</label>
            <input type="text" class="form-control is-invalid" name="name" id="inputName" placeholder="Name" value="" />
            <small id="feedbackName" class="invalid-feedback">Name is required.</small>
        </div>

        <!-- Email -->
        <div class="form-group col-sm">
            <label for="inputEmail4">Email</label>
            <input type="email" class="form-control is-invalid" name="email" id="inputEmail" placeholder="Email" value="" />
            <small id="feedbackEmail" class="invalid-feedback">Email is required.</small>
        </div>
        
        </div>
        <!-- 21th row ends-->
    
    </form>
</div>
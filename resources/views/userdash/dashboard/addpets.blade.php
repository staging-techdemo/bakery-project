@extends('layouts.dashboard.main')

@section('content')
   <section class="dashboard-sec">
        <div class="wrapper-container">
            <div class="dashboard-form-sec">
                <div class="row align-items-center mc-b-3">
                    <div class="col-lg-12 col-md-12 col-12">
                        <div class="primary-heading color-dark">
                            <h2>Add Pet</h2>
                        </div>
                    </div>
                </div>
                <form action="{{route('dashboard.adddPets')}}" method="POST" enctype="multipart/form-data" class="main-form pet-form" id="pet-form">
                      @csrf
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-12">
                        <div class="form-group">
                        <label>Pet Image:</label>
                        </div>
                            <div class="profile-img">
                               
                            <figure><img src="{{asset('images/about-7.jpg')}}" id="logo_img_my" alt="user-img"></figure>
                             
                             <input type="file" id="profile-user-img" required name="picture" class="d-none"  onchange="readURL(this);" accept="image/jpeg, image/png">
                            <label for="profile-user-img"><i class="fa fa-pencil"></i></label>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-12">
                            <div class="form-group">
                                <label>Breed</label>
                                <input type="text" name="breed" required class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-12">
                            <div class="form-group">
                                <label>Pet Species </label>
                                <div class="checkbox">
                                    <input type="radio" name="pet_type" id="pet-type-1" value="dog" checked>
                                    <label for="pet-type-1" class="species-radio-btn"><span></span>Dog</label>
                                </div>
                                <div class="checkbox">
                                    <input type="radio" name="pet_type" id="pet-type-2" value="cat">
                                    <label for="pet-type-2" class="species-radio-btn"><span></span>Cat</label>
                                </div>
                                <div class="checkbox">
                                    <input type="radio" name="pet_type" id="pet-type-3" value="other">
                                    <label for="pet-type-3" class="species-radio-btn"><span></span>Other</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-12 other-pet-div" style="display: none;">
                            <div class="form-group">
                                <label>Other Pet Name</label>
                                <input type="text" name="other_pet_name" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-12">
                            <div class="form-group">
                                <label>Pet Name</label>
                                <input type="text"  name="pet_name" required class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-12">
                            <div class="form-group">
                                <label>Age</label>
                                <input type="text" name="pet_age" required class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-12">
                            <div class="form-group">
                                <label>Color</label>
                                <input type="text" required name="color" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-12">
                            <div class="form-group">
                                <label>Sex </label>
                                <div class="checkbox">
                                    <input type="radio" name="sex" value="1" checked id="sex-radio-1">
                                    <label for="sex-radio-1"><span></span>Male</label>
                                </div>
                                <div class="checkbox">
                                    <input type="radio" name="sex" value="2" id="sex-radio-2">
                                    <label for="sex-radio-2"><span></span>Neutered</label>
                                </div>
                                <div class="checkbox">
                                    <input type="radio" name="sex" value="3" id="sex-radio-3">
                                    <label for="sex-radio-3"><span></span>Female</label>
                                </div>
                                <div class="checkbox">
                                    <input type="radio" name="sex" value="4" id="sex-radio-4">
                                    <label for="sex-radio-4"><span></span>Spayed</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-12 pet-weight-div" style="display: none;">
                            <div class="form-group">
                                <label>Weight </label>
                                <div class="checkbox">
                                    <input type="radio" name="weight-radio" id="weight-radio-1">
                                    <label for="weight-radio-1"><span></span>S (Lorem Ipsum)</label>
                                </div>
                                <div class="checkbox">
                                    <input type="radio" name="weight-radio" id="weight-radio-2">
                                    <label for="weight-radio-2"><span></span>M (Lorem Ipsum)</label>
                                </div>
                                <div class="checkbox">
                                    <input type="radio" name="weight-radio" id="weight-radio-3">
                                    <label for="weight-radio-3"><span></span>L (Lorem Ipsum)</label>
                                </div>
                                <div class="checkbox">
                                    <input type="radio" name="weight-radio" id="weight-radio-4">
                                    <label for="weight-radio-4"><span></span>XL (Lorem Ipsum)</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-12">
                            <div class="form-group">
                                <label>Vet Clinic</label>
                                <input type="text" name="vet_clinic" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-12">
                            <div class="form-group">
                                <label>*Please fill out below ONLY if your pet is LODGING with us!*</label>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-12">
                            <div class="form-group">
                                <label>Feeding</label>
                                <select class="form-control" name="feeding">
                                    <option disabled>Select One</option>
                                    <option value="1">Own Food</option>
                                    <option value="2">NutriSource</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-12">
                            <div class="form-group">
                                <label>Time</label>
                                <select class="form-control" name="time">
                                    <option disabled>Select One</option>
                                    <option value="1">AM Only</option>
                                    <option value="2">PM Only</option>
                                    <option value="3">AM & PM</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-12">
                            <div class="form-group">
                                <label>Amt./Feeding</label>
                                <input type="text" name="amt_feeding" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-12">
                            <div class="form-group">
                                <label>Special Instruction </label>
                                <div class="checkbox">
                                    <input type="radio" name="special_instruction"  id="special-instruction-yes"
                                        value="yes">
                                    <label for="special-instruction-yes"
                                        class="special-instruction-btn"><span></span>Yes</label>
                                </div>
                                <div class="checkbox">
                                    <input type="radio" name="special_instruction" id="special-instruction-no"
                                        value="no" checked>
                                    <label for="special-instruction-no"
                                        class="special-instruction-btn"><span></span>No</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-12">
                            <div class="form-group">
                                <label>Medication </label>
                                <div class="checkbox">
                                    <input type="radio" name="medication" id="medication-yes" value="yes">
                                    <label for="medication-yes" class="medication-btn"><span></span>Yes</label>
                                </div>
                                <div class="checkbox">
                                    <input type="radio" name="medication" id="medication-no" value="no" checked>
                                    <label for="medication-no" class="medication-btn"><span></span>No</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-12 special-instruction-div" style="display: none;">
                            <div class="form-group">
                                <label>Type Special Instruction</label>
                                <input type="text" name="sp_instr" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-12 medication-div" style="display: none;">
                            <div class="form-group">
                                <label>Type Medication</label>
                                <input type="text" name="type_medication" class="form-control">
                            </div>
                        </div>
                      
                        <div class="col-lg-6 col-md-6 col-12">
                            <div class="form-group">
                                <label>Activities </label>
                                <div class="checkbox">
                                    <input type="checkbox" name="activities[]" value="activity1" id="activity-1">
                                    <label for="activity-1"><span></span>Activity 1</label>
                                </div>
                                <div class="checkbox">
                                    <input type="checkbox" name="activities[]"  value="activity2" id="activity-2">
                                    <label for="activity-2"><span></span>Activity 2</label>
                                </div>
                                <div class="checkbox">
                                    <input type="checkbox" name="activities[]" value="activity3"  id="activity-3">
                                    <label for="activity-3"><span></span>Activity 3</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-12">
                            <div class="form-group notes">
                                <label>Notes</label>
                                <textarea class="form-control" name="notes" rows="4" maxlength="512"></textarea>
                                <span class="notes-counter">0 of 512 max characters</span>
                            </div>
                        </div>
                      
                    </div>
                    <input type="hidden" id="btn_type" name="btn_type" >
                    <div class="text-lg-right text-md-right">
                        <button type="button" class="primary-btn primary-bg add-pets-submit" data-type="1" >Add Pets</button>
                        <button type="button"  class="primary-btn primary-bg add-pets-submit" data-type="2">Add Another Pet</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
@section('css')
<style type="text/css">
  /*in page css here*/
</style>
@endsection
@section('js')
<script type="text/javascript">
     function readURL(input) {
        if (input.files && input.files[0]) {
           // console.log('sad');
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#logo_img_my')
                    .attr('src', e.target.result);
                    console.log(e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
  function HideShowDivFn(...divs){
            for(var i = 0; i < divs.length; i++){
                var element = $(`${divs[i]}`);

                var parentDiv = $(this).parent();
                var inputVal = parentDiv.find('input').val();

                if (inputVal == 'yes') {
                    element.show();
                } else if (inputVal == 'no') {
                    element.hide();
                }
            }
        }
(()=>{
  /*in page css here*/
 $('.species-radio-btn').on('click', function () {

            var otherPetDiv = $('.other-pet-div');
            var weightPetDiv = $('.pet-weight-div');

            var parentDiv = $(this).parent();
            var inputVal = parentDiv.find('input').val();

            if (inputVal == 'dog') {
                otherPetDiv.hide();
                weightPetDiv.hide();
            } else if (inputVal == 'other') {
                otherPetDiv.show();
                weightPetDiv.hide();
            } else if (inputVal == 'cat') {
                otherPetDiv.hide();
                weightPetDiv.show();
            }

        });
        
          $('.add-more-btn').on('click',function(){
            HideShowDivFn.call(this,'.add-pet-table');
        });
        $('.special-instruction-btn').on('click',function(){
            HideShowDivFn.call(this,'.special-instruction-div');
        });
        $('.medication-btn').on('click',function(){
            HideShowDivFn.call(this,'.medication-div');
        });

        $('.notes textarea').on('keyup',function(e) {
            var maxLength = $(this).attr('maxlength');   
            var counterElement = $(this).parent().find('.notes-counter');
            var counter = $(this).val().length;
   
            // if(e.keyCode == 8 || e.which == 8){
            //     counter--;
            // }

            console.log(counter);
            if($(this).val().length > maxLength) return false;
            var html = `${counter} of ${maxLength} max characters`;
            counterElement.html(html);    
        });


    $('.add-pets-submit').click(function(e){
        e.preventDefault();
        
           var btn_type =   $(this).data('type');
           $('#btn_type').val(btn_type);
        
        var data = new FormData(document.getElementById("pet-form"));
          //var data = $(".pet-form").serialize();
          var url = '{{ route('dashboard.adddPets') }}';


                $.ajaxSetup({
                            headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                    
                    $.ajax({

                            type: "POST",
                            url: url,
                           
                            data: data,
                            dataType: "json",
                            enctype: 'multipart/form-data',
                            processData: false,  // tell jQuery not to process the data
                            contentType: false,

                            success: function (msg) {

                                console.log(msg.status);
                                if(msg.status == 1)
                                {
                                    if(msg.btn_type == 1)
                                    {

                                        $.toast({
                                    heading: 'Success!',
                                    position: 'bottom-right',
                                    text:  msg.msg,
                                    loaderBg: '#ff6849',
                                    icon: 'success',
                                    hideAfter: 4000,
                                    stack: 6
                                    });

                                    $('#pet-form')[0].reset();
                                    setInterval(() => {
                                        window.location.href ="{{route('dashboard.myPets')}}" ;
                                    }, 4000); 

                                }
                                else if(msg.btn_type == 2)
                                    {
                                    $.toast({
                                        heading: 'Success!',
                                        position: 'bottom-right',
                                        text:  msg.msg,
                                        loaderBg: '#ff6849',
                                        icon: 'success',
                                        hideAfter: 4000,
                                        stack: 6
                                        });

                                        $('#pet-form')[0].reset();
                                        setInterval(() => {
                                            window.location.href ="{{route('dashboard.adddnewPets')}}" ;
                                        }, 4000); 
                                    }
                                }

                                else
                                {
                                    $.toast({
                                        heading: 'Error!',
                                        position: 'bottom-right',
                                        text:  msg.error,
                                        loaderBg: '#ff6849',
                                        icon: 'error',
                                        hideAfter: 4000,
                                        stack: 6
                                    });
                                }
                            
                            
                            },
                            beforeSend: function () {
                                
                            }
                    });
                });
               



})()
</script>
@endsection

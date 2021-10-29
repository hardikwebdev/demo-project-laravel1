<div class="">
    <div class="ibox-content ibox-border-rad cus-heght-full col-sm-12">
        <h4 class="p-b-sm">Personal details</h4>
        <div class="row ">
            <div class="col-sm-4 ">
                <div class="form-group">
                    <label>Full name</label>                 
                    {!! Form::text('name',old('name'),['class'=>'form-control','placeholder'=>'Enter Full name','id'=> 'fullname']) !!}
                    <span class="help-block text-danger">{{ $errors->first('name') }}</span>
                </div>
            </div> 
            <div class="col-sm-4 pl-0">
                <div class="form-group">
                    <label>Identification Number</label>             
                    {!! Form::text('ic_number',old('ic_number'),['class'=>'form-control','placeholder'=>'Enter Identification Number','maxlength'=>12,'id'=>'ic_number']) !!}
                    <span class="help-block text-danger">{{ $errors->first('ic_number') }}</span>
                </div> 
            </div> 
            
            <div class="col-sm-4 pl-0 ">        
                <div class="form-group">
                    <label>Phone number</label> 
                    {!! Form::text('phone_number',old('phone_number'),['class'=>'form-control','placeholder'=>'Enter Phone Number']) !!}
                    <span class="help-block text-danger">{{ $errors->first('phone_number') }}</span>
                </div>       
            </div>
        </div>
        <div class="row ">        

            <div class="col-sm-6 ">
                <div class="form-group">
                    <label>Address</label> 
                    {!! Form::textarea('address', old('address'), ['class' => 'form-control form-control', 'rows' => 6,  'style' => 'resize:none','placeholder' => 'Enter Address']) !!}
                    <span class="help-block text-danger">{{ $errors->first('address') }}</span>
                </div> 
            </div>
            <div class="col-sm-6 ">
                <div class="row">
                    <div class="col-sm-6">        
                        <div class="form-group">
                            <label>City</label> 
                            {!! Form::text('city',old('city'),['class'=>'form-control','placeholder'=>'Enter City']) !!}
                            <span class="help-block text-danger">{{ $errors->first('city') }}</span>
                        </div>       
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>State</label> 
                            {!! Form::text('state',old('state'),['class'=>'form-control','placeholder'=>'Enter State']) !!}
                            <span class="help-block text-danger">{{ $errors->first('state') }}</span>
                        </div> 
                    </div>
                    <div class="col-sm-12 m-t-sm">
                        <div class="form-group">
                            <label>Country</label> 
                            {!! Form::select('country',$counties,old('country'),['class'=>'form-control','placeholder'=>'Select Country','id'=>'country_id']) !!}
                            <span class="help-block text-danger">{{ $errors->first('country') }}</span>
                        </div>
                    </div>  
                </div>  
            </div>
        </div>  
    </div>  

    <div class="container">
        <div class="row">
          <div class="col">   
          </div>
          <div class="col">
          </div>
        </div>
    </div>

    <div class="row d-flex ">
        <div class=" col-sm-6 m-t-lg">
            <div class="ibox-content ibox-border-rad cus-heght-full">
                <h4 class="p-b-sm">Account Details</h4>
                <div class="row ">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Email</label> 
                            {!! Form::email('email',old('email'),['class'=>'form-control','placeholder'=>'Enter Email']) !!}
                            <span class="help-block text-danger">{{ $errors->first('email') }}</span>
                        </div> 
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Username</label> 
                            {!! Form::text('username',old('username'),['class'=>'form-control','placeholder'=>'Enter Username']) !!}
                            <span class="help-block text-danger">{{ $errors->first('username') }}</span>
                        </div> 
                    </div> 
                </div>
                <div class="row ">
                    <div class="col-sm-6  ">
                        <div class="form-group">
                            <label>Login Password</label> 
                            {!! Form::password('password',['id'=>'password','class'=>'form-control','placeholder'=>'Enter Password']) !!}
                            <span class="help-block text-danger">{{ $errors->first('password') }}</span>
                        </div> 
                    </div>
                    <div class="col-sm-6">        
                        <div class="form-group">
                            <label>Repeat Login Password</label> 
                            {!! Form::password('retype_password',['class'=>'form-control','placeholder'=>'Enter Repeat Password']) !!}
                            <span class="help-block text-danger">{{ $errors->first('retype_password') }}</span>
                        </div>       
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Security Password</label> 
                            {!! Form::password('secure_password',['id'=>'secure_password','class'=>'form-control','placeholder'=>'Enter Security Password']) !!}
                            <span class="help-block text-danger">{{ $errors->first('secure_password') }}</span>
                        </div> 
                    </div>
                    <div class="col-sm-6">        
                        <div class="form-group">
                            <label>Repeat Security Password</label> 
                            {!! Form::password('retype_secure_password',['class'=>'form-control','placeholder'=>'Enter Repeat Security Password']) !!}
                            <span class="help-block text-danger">{{ $errors->first('retype_secure_password') }}</span>
                        </div>       
                    </div>
            </div>   
            <div class="row form-group-all">
                <div class="col-sm-8 pr-0 ">          
                    <div class="form-group">
                        <label>Sponsor</label> 
                        {!! Form::text('sponsor',old('sponsor'),['class'=>'form-control','placeholder'=>'Enter Sponsor','id'=>'sponsor_username']) !!}
                    </div> 
                </div>
                <div class="col-sm-4 ">
                    <div class="form-group">
                        <label>&nbsp;&nbsp;</label> 
                        <a class="btn-primary btn btn-block verify-sponser">Verify Sponsor</a>
                    </div>
                </div>
                <div class="col-md-12 ">
                    <input id="sponsor_check" type="hidden" class="form-control @error('sponsor_check') is-invalid @enderror" name="sponsor_check" value="{{ old('sponsor_check') }}"  autocomplete="sponsor_check" autofocus placeholder="{{ __('Sponsor Username') }}">
                    <span class="cus-error-sponsor error">{{trans('auth.verify_sponsor_wrong')}} </span>
                    <label class="cus-error-sponsor">{{trans('custom.sponsor_user_not_found_not__valid_sponsor')}}</label>
                    <label class="cus-success-sponsor sucess">{{trans('custom.sponsor_username_verified')}}</label>
                </div>
                <span class="col-sm-12 help-block text-danger">{{ $errors->first('sponsor') }}</span>
            </div>
        </div>
    </div>
    <div class=" col-sm-6 m-t-lg">
        
        <div class="ibox-content ibox-border-rad cus-heght-full">
            <h4 class="p-b-sm">Bank Details</h4>
            <div class="row ">
                <div class="col-sm-12  ">
                    <div class="form-group">
                        <label>Name of Bank</label> 
                        {!! Form::text('bank_name',old('bank_name'),['class'=>'form-control','placeholder'=>'Enter Name of Bank']) !!}
                        <span class="help-block text-danger">{{ $errors->first('bank_name') }}</span>
                    </div> 
                </div>
                <div class="col-sm-12  ">        
                    <div class="form-group">
                        <label>Name of Account Holder</label> 
                        {!! Form::text('acc_holder_name',old('acc_holder_name'),['class'=>'form-control','placeholder'=>'Enter Account Holder Name']) !!}
                        <span class="help-block text-danger">{{ $errors->first('acc_holder_name') }}</span>
                    </div>       
                </div>
                <div class="col-sm-6">        
                    <div class="form-group">
                        <label>Account Number</label> 
                        {!! Form::text('acc_number',old('acc_number'),['class'=>'form-control','placeholder'=>'Enter Account Number']) !!}
                        <span class="help-block text-danger">{{ $errors->first('acc_number') }}</span>
                    </div>       
                </div>

                <div class="col-sm-6">        
                    <div class="form-group">
                        <label>Swift Code</label> 
                        {!! Form::text('swift_code',old('swift_code'),['class'=>'form-control','placeholder'=>'Enter Swift Code']) !!}
                        <span class="help-block text-danger">{{ $errors->first('swift_code') }}</span>
                    </div>       
                </div>
                <div class="col-sm-6">        
                    <div class="form-group">
                        <label>Bank Branch</label> 
                        {!! Form::text('branch',old('branch'),['class'=>'form-control','placeholder'=>'Enter Bank Branch']) !!}
                        <span class="help-block text-danger">{{ $errors->first('branch') }}</span>
                    </div>       
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Bank Account Country</label> 
                        {!! Form::select('bank_country_id',$counties,old('country'),['class'=>'form-control','placeholder'=>'Select Bank Account Country']) !!}
                        <span class="help-block text-danger">{{ $errors->first('country') }}</span>
                    </div>
                </div>  
            </div>
        </div>
    </div>
</div>
<div class="row d-flex ">
    <div class=" col-sm-6 m-t-lg">
        <div class="ibox-content ibox-border-rad cus-heght-full">
            <h4 class="p-b-sm">User Agreement</h4>
            <p>I hereby attest and certify that the above information is complete and accurate and I agree to be bound by these terms and conditions. I also authorize Vextrader to verify and or all of the foregoing information. This electronic signature has the same validity and effect as a signature affixed by hand.</p>
            <p>Please check the boxes below to acknowledge your acceptance, agreement and understanding of these terms and agreements</p>
            <div class="row">
                <div class="col-sm-6 ">  
                    <div class="col-sm-12 ">        
                        <div class="checkbox ">
                            <input type="checkbox" class="ml-0" id="checkbox1" name="terms_condition[]" value="aml_policy_statement">
                            <label for="checkbox1">
                                <a href="{{asset('AML.pdf')}}" target="_blank" class="font-regular text-darkGrey">AML Policy Statement</a>
                            </label>
                        </div>      
                    </div>
                    <div class="col-sm-12 ">        
                        <div class="checkbox ">
                            <input type="checkbox" class="ml-0" id="checkbox2"  name="terms_condition[]" value="risk_disclosure_statement">
                            <label for="checkbox2">
                                <a href="{{asset('Risk-Disclosure.pdf')}}" target="_blank" class="font-regular text-darkGrey">Risk Disclosure Statement</a>
                            </label>
                        </div>      
                    </div>
                    <div class="col-sm-12 ">        
                        <div class="checkbox ">
                            <input type="checkbox" class="ml-0" id="checkbox3"  name="terms_condition[]" value="client_agreement">
                            <label for="checkbox3">
                                <a href="{{asset('TC.pdf')}}" target="_blank" class="font-regular text-darkGrey">User Agreement</a>
                            </label>
                        </div>      
                    </div>
                    <div class="col-sm-12 ">        
                        <div class="checkbox ">
                            <input type="checkbox" class="ml-0" id="checkbox4"  name="terms_condition[]" value="poa">
                            <label for="checkbox4">
                                <a href="{{asset('Privacy-Policy.pdf')}}" target="_blank" class="font-regular text-darkGrey">POA</a>
                            </label>
                        </div>      
                    </div>
                    <span class="help-block text-danger">{{ $errors->first('terms_condition') }}</span>
                </div>
                <div class="col-sm-6 ">        
                    <div class="form-group">
                        <label>Signature</label> 
                        {!! Form::text('signature',old('reg_signature'),['class'=>'form-control','placeholder'=>'Enter Signature']) !!}
                        <span class="help-block text-danger">{{ $errors->first('signature') }}</span>
                    </div>       
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<div class="m-t-lg">
    <button class="btn  btn-primary" type="submit"><strong>Save</strong></button>
    <a class="btn btn-danger" href="{{route('user.index')}}"><strong>Cancel</strong></a>
</div>
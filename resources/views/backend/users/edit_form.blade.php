<div class="">
    <div class="ibox-content ibox-border-rad cus-heght-full col-sm-12">
        <h4 class="p-b-sm">Personal details</h4>
        <!-- <h3 class="m-t-none m-b">Personal details</h3> -->
        <div class="row">
            <div class="col-sm-4 ">
                <div class="form-group">
                    <label>Full name</label>                 
                    {!! Form::text('name',old('name'),['class'=>'form-control','placeholder'=>'Enter Full name','id' => 'fullname']) !!}
                    <span class="help-block text-danger">{{ $errors->first('name') }}</span>
                </div>
            </div> 
            <div class="col-sm-4">
                <div class="form-group">
                    <label>Identification Number</label>             
                    {!! Form::text('ic_number',old('ic_number',($user->identification_number)),['class'=>'form-control','placeholder'=>'Enter Identification Number','maxlength'=>12,'id'=>'ic_number']) !!}
                    <span class="help-block text-danger">{{ $errors->first('ic_number') }}</span>
                </div> 
            </div>    
            <div class="col-sm-4 ">        
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
                    <div class="col-sm-6  ">
                        <div class="form-group">
                            <label>State</label> 
                            {!! Form::text('state',old('state'),['class'=>'form-control','placeholder'=>'Enter State']) !!}
                            <span class="help-block text-danger">{{ $errors->first('state') }}</span>
                        </div> 
                    </div>
                    <div class="col-sm-6  ">        
                        <div class="form-group">
                            <label>City</label> 
                            {!! Form::text('city',old('city'),['class'=>'form-control','placeholder'=>'Enter City']) !!}
                            <span class="help-block text-danger">{{ $errors->first('city') }}</span>
                        </div>       
                    </div>
                    <div class="col-sm-12 m-t-sm ">
                        <div class="form-group">
                            <label>Country</label> 
                            {!! Form::select('country',$counties,old('country',@$user->country_id),['class'=>'form-control','placeholder'=>'Select Country','id'=>'country_id']) !!}
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
                            {!! Form::text('username',old('username',@$user->username),['class'=>'form-control','placeholder'=>'Enter Username','readonly']) !!}
                            <span class="help-block text-danger">{{ $errors->first('username') }}</span>
                        </div> 
                    </div> 
                </div> 
                <div class="row ">
                    <div class="col-sm-6  ">
                        <div class="form-group">
                            <label>Login Password</label> 
                            {!! Form::password('password',['class'=>'form-control','id'=>'password','placeholder'=>'Enter Password']) !!}
                            <span class="help-block text-danger">{{ $errors->first('password') }}</span>
                        </div> 
                    </div>
                    <div class="col-sm-6  ">
                        <div class="form-group">
                            <label>Repeat Login Password</label> 
                            {!! Form::password('retype_password',['class'=>'form-control','placeholder'=>'Enter Repeat Password']) !!}
                            <span class="help-block text-danger">{{ $errors->first('retype_password') }}</span>
                        </div>       
                    </div>
                    <div class="col-sm-6  ">
                        <div class="form-group">
                            <label>Security Password</label> 
                            {!! Form::password('secure_password',['class'=>'form-control','id'=>'secure_password','placeholder'=>'Enter Security Password']) !!}
                            <span class="help-block text-danger">{{ $errors->first('secure_password') }}</span>
                        </div> 
                    </div>
                    <div class="col-sm-6  ">        
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
                            {!! Form::text('sponsor',old('sponsor',isset($user->sponsor)  && $user->sponsor!=null?$user->sponsor->username:""),['class'=>'form-control','placeholder'=>'Enter Sponsor','id'=>'sponsor_username']) !!}
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

                {{-- <div class="row ">
                    <div class="col-sm-8">          
                        <div class="form-group">
                            <label>Sponsor</label> 
                            {!! Form::text('sponsor',old('sponsor',isset($user->sponsor)  && $user->sponsor!=null?$user->sponsor->username:""),['class'=>'form-control','placeholder'=>'Enter Sponsor','id'=>'sponsor_username']) !!}
                        </div> 
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>&nbsp;&nbsp;</label> 
                            <a class="btn-primary btn btn-block verify-sponser">Verify Sponsor</a>
                        </div>
                    </div>
                    <span class="help-block text-danger">{{ $errors->first('sponsor') }}</span>

                </div> --}}
                <div class="row">
                    <div class="col-sm-6"> 
                       <div class="col-sm-12">        
                        <div class="checkbox ">
                            {{-- <input class="ml-0" id="is_consultant"  name="is_consultant" type="checkbox" value="1" @if($user->is_consultant) checked @endif @if(($user->user_referral && !empty($user->user_referral->downline_ids)) || $user->userwallet->pips_rebate_wallet != 0 || $user->userwallet->pips_commission_wallet != 0 || $user->userwallet->overriding_wallet != 0 || $user->userwallet->leader_bonus_wallet != 0 || $user->userwallet->profit_sharing_wallet != 0) disabled @endif> --}}
                            {{-- <label for="is_consultant">
                                Is Consultant
                            </label> --}}
                        </div> 
                    </div>      
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6"> 
                   <div class="col-sm-12">        
                    <div class="checkbox ">
                        {{-- <input class="ml-0" id="is_investor"  name="is_investor" type="checkbox" value="1" @if($user->is_investor) checked @endif> --}}
                        {{-- <label for="is_investor">
                            Is Investor
                        </label> --}}
                    </div> 
                </div>      
            </div>
        </div>
    </div>
</div>
<div class=" col-sm-6 m-t-lg">
    <div class="ibox-content ibox-border-rad cus-heght-full">
        <h4 class="p-b-sm">Bank Details</h4>
        <div class="row">
            <div class="col-sm-12  ">
                <div class="form-group">
                    <label>Name of Bank</label> 
                    {!! Form::text('bank_name',old('bank_name',(isset($user->userbank)  && $user->userbank!=null?$user->userbank->name:"")),['class'=>'form-control','placeholder'=>'Enter Name of Bank']) !!}
                    <span class="help-block text-danger">{{ $errors->first('bank_name') }}</span>
                </div> 
            </div>
            <div class="col-sm-12  ">        
                <div class="form-group">
                    <label>Name of Account Holder</label> 
                    {!! Form::text('acc_holder_name',old('acc_holder_name',(isset($user->userbank)  && $user->userbank!=null?$user->userbank->account_holder:"")),['class'=>'form-control','placeholder'=>'Enter Account Holder Name']) !!}
                    <span class="help-block text-danger">{{ $errors->first('acc_holder_name') }}</span>
                </div>       
            </div>
            <div class="col-sm-6  ">        
                <div class="form-group">
                    <label>Account Number</label> 
                    {!! Form::text('acc_number',old('acc_number',(isset($user->userbank)  && $user->userbank!=null?$user->userbank->account_number:"")),['class'=>'form-control','placeholder'=>'Enter Account Number']) !!}
                    <span class="help-block text-danger">{{ $errors->first('acc_number') }}</span>
                </div>       
            </div>
            <div class="col-sm-6  ">        
                <div class="form-group">
                    <label>Swift Code</label> 
                    {!! Form::text('swift_code',old('swift_code',(isset($user->userbank)  && $user->userbank!=null?$user->userbank->swift_code:"")),['class'=>'form-control','placeholder'=>'Enter Swift Code']) !!}
                    <span class="help-block text-danger">{{ $errors->first('swift_code') }}</span>
                </div>       
            </div>
            <div class="col-sm-6  ">        
                <div class="form-group">
                    <label>Bank Branch</label> 
                    {!! Form::text('branch',old('branch',(isset($user->userbank)  && $user->userbank!=null?$user->userbank->branch:"")),['class'=>'form-control','placeholder'=>'Enter Bank Branch']) !!}
                    <span class="help-block text-danger">{{ $errors->first('branch') }}</span>
                </div>       
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Bank Account Country</label> 
                    {!! Form::select('bank_country_id',$counties,old('bank_country_id',@$user->userbank['bank_country_id']),['class'=>'form-control','placeholder'=>'Select Bank Account Country']) !!}
                    <span class="help-block text-danger">{{ $errors->first('bank_country_id') }}</span>
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
                <div class="col-sm-6">
                    <div class="col-sm-12">        
                        <div class="checkbox ">
                            {!! Form::checkbox('terms_condition[]','aml_policy_statement',(isset($user->user_agreement)  && @$user->user_agreement->aml_policy_statement!=0?true:false),['class'=>'ml-0','id'=>"checkbox1"]) !!}
                            <label for="checkbox1">
                                <a href="{{asset('AML.pdf')}}" target="_blank" class="font-regular text-darkGrey">AML Policy Statement</a>
                            </label>
                        </div>      
                    </div>
                    <div class="col-sm-12 ">        
                        <div class="checkbox ">
                            {!! Form::checkbox('terms_condition[]','risk_disclosure_statement',(isset($user->user_agreement)  && @$user->user_agreement->risk_disclosure_statement!=0?true:false),['class'=>'ml-0','id'=>"checkbox2"]) !!}


                            <label for="checkbox2">
                                <a href="{{asset('Risk-Disclosure.pdf')}}" target="_blank" class="font-regular text-darkGrey">Risk Disclosure Statement</a>
                            </label>
                        </div>      
                    </div>
                    <div class="col-sm-12 ">        
                        <div class="checkbox ">
                            {!! Form::checkbox('terms_condition[]','client_agreement',(isset($user->user_agreement)  && @$user->user_agreement->user_agreement!=0?true:false),['class'=>'ml-0','id'=>"checkbox3"]) !!}
                            <label for="checkbox3">
                                <a href="{{asset('TC.pdf')}}" target="_blank" class="font-regular text-darkGrey">Terms and Condition</a>
                            </label>
                        </div>      
                    </div>
                    <div class="col-sm-12 ">        
                        <div class="checkbox ">
                            {!! Form::checkbox('terms_condition[]','poa',(isset($user->user_agreement)  && @$user->user_agreement->poa!=0?true:false),['class'=>'ml-0','id'=>"checkbox4"]) !!}
                            <label for="checkbox4">
                                <a href="{{asset('Privacy-Policy.pdf')}}" target="_blank" class="font-regular text-darkGrey">Privacy Policy</a>
                            </label>
                        </div>      
                    </div>
                </div>
            </div>
            <span class="help-block text-danger">{{ $errors->first('terms_condition') }}</span>
        </div>
    </div>
    {{-- <div class=" col-sm-6 m-t-lg">
        <div class="ibox-content ibox-border-rad cus-heght-full">
            <h4 class="p-b-sm">MT5 Member Details</h4>
            <div class="form-group">
                <label>MT5 ID</label> 
                {!! Form::number('mt4_id',old('mt4_id',$user->mt4_user_id),['class'=>'form-control','placeholder'=>'Enter MT5 ID','maxlength'=>'8']) !!}
                <span class="help-block text-danger">{{ $errors->first('mt4_id') }}</span>
            </div>
            <div class="block m-t-lg"> 
                <div class="form-group">
                    <label class="control-label">MT5 Password</label> <br>
                    {!! Form::text('mt4_password',$user->mt4_password,['class'=>'form-control','placeholder'=>'Enter MT5 Password','value'=>$user->mt4_password]) !!}
                    <span class="help-block text-danger">{{ $errors->first('mt4_password') }}</span>
                </div>
            </div>
        </div>  
    </div> --}}
</div>
<div class="row d-flex ">
    <div class="col-sm-12">
        <div class="ibox-content ibox-border-rad cus-heght-full m-t-lg">
            <h4 class="p-b-sm">Other Details</h4>
            <div class="row ">
                <div class="col-sm-6">
                        <!-- <div class="form-group">
                            <label>Signature</label> 
                            {!! Form::hidden('signature',old('signature'),['class'=>'form-control','placeholder'=>'Enter Signature']) !!}
                            <span class="help-block text-danger">{{ $errors->first('signature') }}</span>
                        </div>      -->  
                        {{-- <div class="form-group">
                            <label>User Rank</label> 
                            {!! Form::select('rank_id',$ranks,old('rank_id',@$user->rank_id),['class'=>'form-control']) !!}
                            <span class="help-block text-danger">{{ $errors->first('rank_id') }}</span>
                        </div>        --}}
                        {{-- <div class="form-group">
                            <label>User Package</label> 
                            {!! Form::select('package_id',$packages,old('user_package',@$user->package_id),['class'=>'form-control','placeholder'=>"No Package"]) !!}
                            <span class="help-block text-danger">{{ $errors->first('package_id') }}</span>
                        </div>        --}}
                        <div class="form-group">
                            <label class="control-label">User Status</label> <br>
                            <label>{!! Form::radio('status','active',$user->status!='active'?false:true,[]) !!} Active</label>
                            <label>{!! Form::radio('status','inactive',$user->status!='active'?true:false,[]) !!} Inactive</label>
                            <span class="help-block text-danger">{{ $errors->first('package_id') }}</span>
                        </div>       
                    </div>
                    {{-- <div class="col-sm-6">
                        <!-- <div class="clearfix"></div> -->
                        <div class="col-sm-12"> 
                            <div class="form-group">
                                <label class="control-label">Fixed Ranking</label> <br>
                                <label>{!! Form::radio('fixed_rank','1',$user->fixed_rank!='0'?true:false,[]) !!} Yes</label>
                                <label>{!! Form::radio('fixed_rank','0',$user->fixed_rank!='1'?true:false,[]) !!} No</label>
                                <span class="help-block text-danger">{{ $errors->first('fixed_rank') }}</span>
                            </div>       
                        </div>
                        <div class="col-sm-12"> 
                            <div class="form-group">
                                <label class="control-label">PROMO Account</label> <br>
                                <label>{!! Form::radio('promo_account','1',$user->promo_account!='0'?true:false,[]) !!} Yes</label>
                                <label>{!! Form::radio('promo_account','0',$user->promo_account!='1'?true:false,[]) !!} No</label>
                                <span class="help-block text-danger">{{ $errors->first('promo_account') }}</span>
                            </div>       
                        </div>
                        <div class="col-sm-12"> 
                            <div class="form-group">
                                <label class="control-label">Enable All Withdrawal Payment Methods</label> <br>
                                <label>{!! Form::radio('payment_methods','1',$user->payment_methods!='0'?true:false,[]) !!} Yes</label>
                                <label>{!! Form::radio('payment_methods','0',$user->payment_methods!='1'?true:false,[]) !!} No</label>
                                <span class="help-block text-danger">{{ $errors->first('payment_methods') }}</span>
                            </div>       
                        </div>
                    </div>          --}}
                </div>
            </div>
        </div>
    </div>
</div>
<hr>
<div class="m-t-lg">
    <button class="btn btn-primary " type="submit"><strong>Save</strong></button>
    <a class="btn btn-danger " href="{{\URL::previous()}}"><strong>Cancel</strong></a>
</div>
<div class="clearfix"></div>
{{-- <input type="hidden" name="mt4_pwd" value="{{$user->mt4_password}}"> --}}



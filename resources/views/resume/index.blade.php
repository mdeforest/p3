@extends('layouts.master')

@section('content')
<div class='container'>
    <section class='banner' id='intro'>
        <h1><img src='images/logo.png' alt='Resume Creator Logo'></h1>
        <p id='instructions'>Create a Resume by choosing a template and filling out the required fields below</p>
        <div class='button-container'>
            <a class='button' href='#choose-template'>Let's Go!</a>
        </div>
    </section>
    <form class='form' method='POST' action='create-resume'>
        {{ Debugbar::info($errors) }}
        {{ csrf_field() }}
        @if(count($errors) > 0)
            <section id='choose-template' class='no-padding'>
            <p class='error-message'>There was an error with your submission. Please fix all errors below.</p>
        @else
            <section id='choose-template'>
        @endif
                <a href='#intro'>
                    <div class='arrow-up'></div>
                </a>
                <h2>Choose a Template</h2>
                <div class='templates'>
                    <div class='column'>
                        <input type='radio'
                               name='template'
                               id='temp-1'
                               value='temp-1' {{ $errors->get('template') && $errors->get('template') == 'temp-1' ? 'checked' : '' }} >
                        <label for='temp-1'>
                            <img class="template-img" src='templates/temp-1/temp-1.png' alt='Template 1'>
                        </label>
                    </div>
                    <div class='column'>
                        <input type='radio'
                               name='template'
                               id='temp-2'
                               value='temp-2' {{ $errors->get('template') && $errors->get('template') == 'temp-2' ? 'checked' : '' }} >
                        <label for='temp-2'>
                            <img class="template-img" src='templates/temp-2/temp-2.png' alt='Template 2'>
                        </label>
                    </div>
                </div>
                <a href='#basic-info'>
                    <div class='arrow-down'></div>
                </a>
            </section>
            <section id='basic-info'>
                <a href='#choose-template'>
                    <div class='arrow-up'></div>
                </a>
                <h2>Basic Information</h2>
                <div class='basic-info-content'>
                    <fieldset>
                        <label for='firstName'>First Name</label>
                        <span class='info'>Required</span>
                        <input type='text' id='firstName' name='firstName' value=" {{ old('firstName') }}">
                        <span class='error'>{{ $errors->first('firstName') }}</span>
                    </fieldset>
                    <fieldset>
                        <label for='lastName'>Last Name</label>
                        <span class='info'>Required</span>
                        <input type='text' id='lastName' name='lastName' value="{{ old('lastName') }}">
                        <span class='error'>{{ $errors->first('lastName') }}</span>
                    </fieldset>
                    <div class='clearfix'></div>
                    <fieldset>
                        <label for='jobTitle'>Profession</label>
                        <span class='info'>Required</span>
                        <input type='text' id='jobTitle' name='jobTitle' value="{{ old('jobTitle') }}">
                        <span class='error'>{{ $errors->first('jobTitle') }}</span>
                    </fieldset>
                    <div class='clearfix'></div>
                    <fieldset>
                        <label for='city'>City</label>
                        <span class='info'>Required</span>
                        <input type='text' id='city' name='city' value="{{ old('city') }}">
                        <span class='error'>{{ $errors->first('city') }}</span>
                    </fieldset>
                    <fieldset>
                        <label for='state'>State</label>
                        <select id='state' name='state'>
                            <option value="AL" selected>Alabama</option>
                            <option value="AK">Alaska</option>
                            <option value="AZ">Arizona</option>
                            <option value="AR">Arkansas</option>
                            <option value="CA">California</option>
                            <option value="CO">Colorado</option>
                            <option value="CT">Connecticut</option>
                            <option value="DE">Delaware</option>
                            <option value="DC">District Of Columbia</option>
                            <option value="FL">Florida</option>
                            <option value="GA">Georgia</option>
                            <option value="HI">Hawaii</option>
                            <option value="ID">Idaho</option>
                            <option value="IL">Illinois</option>
                            <option value="IN">Indiana</option>
                            <option value="IA">Iowa</option>
                            <option value="KS">Kansas</option>
                            <option value="KY">Kentucky</option>
                            <option value="LA">Louisiana</option>
                            <option value="ME">Maine</option>
                            <option value="MD">Maryland</option>
                            <option value="MA">Massachusetts</option>
                            <option value="MI">Michigan</option>
                            <option value="MN">Minnesota</option>
                            <option value="MS">Mississippi</option>
                            <option value="MO">Missouri</option>
                            <option value="MT">Montana</option>
                            <option value="NE">Nebraska</option>
                            <option value="NV">Nevada</option>
                            <option value="NH">New Hampshire</option>
                            <option value="NJ">New Jersey</option>
                            <option value="NM">New Mexico</option>
                            <option value="NY">New York</option>
                            <option value="NC">North Carolina</option>
                            <option value="ND">North Dakota</option>
                            <option value="OH">Ohio</option>
                            <option value="OK">Oklahoma</option>
                            <option value="OR">Oregon</option>
                            <option value="PA">Pennsylvania</option>
                            <option value="RI">Rhode Island</option>
                            <option value="SC">South Carolina</option>
                            <option value="SD">South Dakota</option>
                            <option value="TN">Tennessee</option>
                            <option value="TX">Texas</option>
                            <option value="UT">Utah</option>
                            <option value="VT">Vermont</option>
                            <option value="VA">Virginia</option>
                            <option value="WA">Washington</option>
                            <option value="WV">West Virginia</option>
                            <option value="WI">Wisconsin</option>
                            <option value="WY">Wyoming</option>
                        </select>
                        <span class='error'>{{ $errors->first('state') }}</span>
                    </fieldset>
                    <div class='clearfix'></div>
                    <fieldset>
                        <label for='email'>Email</label>
                        <input type='text' id='email' name='email' value="{{ old('email') }}">
                        <span class='error'>{{ $errors->first('email') }}</span>
                    </fieldset>
                    <fieldset>
                        <label for='phoneNumber'>Phone Number</label>
                        <input type='text' id='phoneNumber' name='phoneNumber' value="{{ old('phoneNumber') }}">
                        <span class='error'>{{ $errors->first('phoneNumber') }}</span>
                    </fieldset>
                    <div class='clearfix'></div>
                    <fieldset>
                        <label for='website'>Website</label>
                        <input type='text' id='website' name='website' value="{{ old('website') }}">
                        <span class='error'>{{ $errors->first('website') }}</span>
                    </fieldset>
                    <div class='clearfix'></div>
                </div>
                <a href='#summary'>
                    <div class='arrow-down'></div>
                </a>
            </section>

            <section id='summary'>
                <a href='#basic-info'>
                    <div class='arrow-up'></div>
                </a>
                <h2>Summary</h2>
                <textarea placeholder='List here your top selling points, including your most relevant strengths, skills and core competencies'
                          name='summary'>{{ old('summary') }}</textarea>
                <span class='error'>{{ $errors->first('summary') }}</span>
                <a href='#experience'>
                    <div class='arrow-down'></div>
                </a>
            </section>

            <section id='experience' class='work-experience'>
                <a href='#summary'>
                    <div class='arrow-up'></div>
                </a>
                <h2>Work Experience</h2>
                <div class='button-container'>
                    <button type='button' class='button' onclick='addExperience()'>Add</button>
                </div>
                @if(count($errors->get('experience.*')) > 0)
                <div class='error-message'>
                    <ul>
                        @foreach($errors->get('experience.*') as $error)
                            <li>{{ $error[0] }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <div id='experiences'>
                    @if(old('experience'))
                        {{ Debugbar::info(json_encode(old('experience'))) }}
                        @for($i = 0; $i < count(old('experience.jobTitle')); $i++)
                            <script>addExperience({!! json_encode(old('experience')) !!}, "{{ $i }}")</script>
                        @endfor
                    @endif
                </div>
                <a href='#education-info'>
                    <div class='arrow-down'></div>
                </a>
            </section>

            <section id='education-info' class='education'>
                <a href='#experience'>
                    <div class='arrow-up'></div>
                </a>
                <h2>Education</h2>
                <div class='button-container'>
                    <button type='button' class='button' onclick='addEducation()'>Add</button>
                </div>
                @if (count($errors->get('education.*')) > 0)
                    <div class='error-message'>
                        <ul>
                            @foreach ($errors->get("education.*") as $error)
                                <li>{{ $error[0] }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div id='degrees'>
                    @if (old('education'))
                        @for ($i = 0; $i < count(old('education.degree')); $i++)
                            <script>addEducation({!! json_encode(old('education')) !!}, "{{ $i }}")</script>
                        @endfor
                    @endif
                </div>
                <a href='#additional-info'>
                    <div class='arrow-down'></div>
                </a>
            </section>

            <section id='additional-info'>
                <a href='#education-info'>
                    <div class='arrow-up'></div>
                </a>
                <h2>Additional Information</h2>
                <textarea placeholder='Include other relevant information that employers should know about. This may include activities, experiences and interests that you have that relate to the position you are trying to get'
                          id='additionalInfo' name='additionalInfo'>{{ old('additionalInfo') }}</textarea>
                <span class='error'>{{ $errors->first('additionalInfo') }}</span>
                <a href='#output'>
                    <div class='arrow-down'></div>
                </a>
            </section>

            <section id='output'>
                <a href='#additional-info'>
                    <div class='arrow-up'></div>
                </a>
                <h2>Choose Display Type</h2>
                <select name='output'>
                    <option value='html' selected>HTML</option>
                    <option value='pdf'>PDF</option>
                </select>
                <div class='button-container'>
                    <input id='submit' class='button' type='submit' value='Submit!'>
                </div>
            </section>
    </form>
</div>
@endsection
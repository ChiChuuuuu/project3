@extends('layout.layout')
@section('main')

    <div class="main-panel">

        <div class="main-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="card">
                        <div class="header">
                            <legend>Form Elements</legend>
                        </div>
                        <div class="content">
                            <form method="get" action="/" class="form-horizontal">

                                <fieldset>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">With help</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control">
                                            <span class="help-block">A block of help text that breaks onto a new
                                                line.</span>
                                        </div>
                                    </div>
                                </fieldset>

                                <fieldset>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Password</label>
                                        <div class="col-sm-10">
                                            <input type="password" name="password" class="form-control">
                                        </div>
                                    </div>
                                </fieldset>

                                <fieldset>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Placeholder</label>
                                        <div class="col-sm-10">
                                            <input type="text" placeholder="placeholder" class="form-control">
                                        </div>
                                    </div>
                                </fieldset>

                                <fieldset>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Disabled</label>
                                        <div class="col-sm-10">
                                            <input type="text" placeholder="Disabled input here..." disabled=""
                                                class="form-control">
                                        </div>
                                    </div>
                                </fieldset>

                                <fieldset>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Static control</label>
                                        <div class="col-sm-10">
                                            <p class="form-control-static">hello@creative-tim.com</p>
                                        </div>
                                    </div>
                                </fieldset>

                                <fieldset>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Checkboxes and radios</label>
                                        <div class="col-sm-10">
                                            <div class="checkbox">
                                                <input id="checkbox10" type="checkbox">
                                                <label for="checkbox10">
                                                    First Checkbox
                                                </label>
                                            </div>

                                            <div class="checkbox">
                                                <input id="checkbox11" type="checkbox">
                                                <label for="checkbox11">
                                                    Second Checkbox
                                                </label>
                                            </div>

                                            <div class="radio">
                                                <input type="radio" name="radio10" id="radio5" value="option5" checked="">
                                                <label for="radio5">
                                                    First Radio
                                                </label>
                                            </div>

                                            <div class="radio">
                                                <input type="radio" name="radio10" id="radio6" value="option6">
                                                <label for="radio6">
                                                    Second Radio
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>

                                <fieldset>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Inline checkboxes</label>
                                        <div class="col-sm-10">
                                            <div class="checkbox checkbox-inline">
                                                <input id="checkbox13" type="checkbox">
                                                <label for="checkbox13">
                                                    a
                                                </label>
                                            </div>

                                            <div class="checkbox checkbox-inline">
                                                <input id="checkbox15" type="checkbox">
                                                <label for="checkbox15">
                                                    b
                                                </label>
                                            </div>

                                            <div class="checkbox checkbox-inline">
                                                <input id="checkbox19" type="checkbox">
                                                <label for="checkbox19">
                                                    c
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>

                                <fieldset>
                                    <legend>Input Variants</legend>

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Custom Checkboxes &amp; radios</label>
                                        <div class="col-sm-4 col-sm-offset-1">
                                            <div class="checkbox">
                                                <input id="checkbox1" type="checkbox">
                                                <label for="checkbox1">
                                                    Unchecked
                                                </label>
                                            </div>
                                            <div class="checkbox">
                                                <input id="checkbox2" type="checkbox" checked="">
                                                <label for="checkbox2">
                                                    Checked
                                                </label>
                                            </div>
                                            <div class="checkbox">
                                                <input id="checkbox3" type="checkbox" disabled="">
                                                <label for="checkbox3">
                                                    Disabled unchecked
                                                </label>
                                            </div>
                                            <div class="checkbox">
                                                <input id="checkbox4" type="checkbox" checked="" disabled="">
                                                <label for="checkbox4">
                                                    Disabled checked
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-sm-5">
                                            <div class="radio">
                                                <input type="radio" name="radio1" id="radio1" value="option1">
                                                <label for="radio1">
                                                    Radio is off
                                                </label>
                                            </div>

                                            <div class="radio">
                                                <input type="radio" name="radio1" id="radio2" value="option2" checked="">
                                                <label for="radio2">
                                                    Radio is on
                                                </label>
                                            </div>

                                            <div class="radio">
                                                <input type="radio" name="radio3" id="radio3" value="option3" disabled="">
                                                <label for="radio3">
                                                    Disabled radio is off
                                                </label>
                                            </div>

                                            <div class="radio">
                                                <input type="radio" name="radio4" id="radio4" value="option4" checked=""
                                                    disabled="">
                                                <label for="radio4">
                                                    Disabled radio is on
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>

                                <fieldset>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Input with success</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control valid">
                                        </div>
                                    </div>
                                </fieldset>

                                <fieldset>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Input with error</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control error">
                                        </div>
                                    </div>
                                </fieldset>

                                <fieldset>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Column sizing</label>
                                        <div class="col-sm-10">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <input type="text" placeholder=".col-md-3" class="form-control">
                                                </div>

                                                <div class="col-md-4">
                                                    <input type="text" placeholder=".col-md-4" class="form-control">
                                                </div>

                                                <div class="col-md-5">
                                                    <input type="text" placeholder=".col-md-5" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>

                                <fieldset>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Input groups</label>
                                        <div class="col-sm-3">
                                            <div class="input-group">
                                                <span class="input-group-addon">@</span>
                                                <input type="text" placeholder="Username" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-sm-3">
                                            <div class="input-group">
                                                <input type="text" class="form-control">
                                                <span class="input-group-addon">.00</span>
                                            </div>
                                        </div>

                                        <div class="col-sm-4">
                                            <div class="input-group">
                                                <span class="input-group-addon">$</span>
                                                <input type="text" class="form-control">
                                                <span class="input-group-addon">.00</span>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                            </form>

                        </div>
                    </div> <!-- end card -->
                </div>
            </div>
        </div>
    </div>

@endsection

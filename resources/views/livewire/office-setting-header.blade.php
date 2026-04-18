<div style="margin-top:20px;">
    <form wire:submit.prevent="save">
        <fieldset>
            <legend style="display: flex;justify-content: space-between;">
                <span class="pull-right">
                     Office Header
                </span>
                <div class="col-md-2">
                    <button class="btn btn-primary" wire:click.prevent="addOfficeSettingHeader">
                        <i class="fa fa-plus"></i>
                    </button>
                </div>
            </legend>
        </fieldset>
        @if($officeSettingHeaders)
            @foreach($officeSettingHeaders as $index=>$officeSettingHeader)
                <div class="row">
                    <div class="col-md-6">
                        <div class="input-style-1">
                            <label for="english.{{$index}}">English*</label>
                            <input type="text" id="english.{{$index}}" name="officeSettingHeaders[{{$index}}][english]"
                                   placeholder="English" value="{{old('english')}}"
                                   wire:model="officeSettingHeaders.{{$index}}.english">
                            @error("officeSettingHeaders.$index.english")
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-style-1">
                            <label for="nepali.{{$index}}">नाम *</label>
                            <input type="text" id="nepali.{{$index}}" name="officeSettingHeaders[{{$index}}][nepali]"
                                   placeholder="Nepali" value="{{old('nepali')}}"
                                   wire:model="officeSettingHeaders.{{$index}}.nepali">
                            @error("officeSettingHeaders.$index.nepali")
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="input-style-1">
                            <label for="font_color.{{$index}}">Font Color *</label>
                            <input type="color" id="font_color.{{$index}}"
                                   name="officeSettingHeaders[{{$index}}][font_color]"
                                   placeholder="Font Color" value="{{old('font_color')}}"
                                   wire:model="officeSettingHeaders.{{$index}}.font_color">
                            @error("officeSettingHeaders.$index.font_color")
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="input-style-1">
                            <label for="font_size.{{$index}}">Font Size *</label>
                            <input type="text" id="font_size.{{$index}}"
                                   name="officeSettingHeaders[{{$index}}][font_size]"
                                   placeholder="Font Size" value="{{old('font_size')}}"
                                   wire:model="officeSettingHeaders.{{$index}}.font_size">
                            @error("officeSettingHeaders.$index.font_size")
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="input-style-1">
                            <label for="font_family.{{$index}}">Font Family *</label>
                            <input type="text" id="font_family.{{$index}}"
                                   name="officeSettingHeaders[{{$index}}][font_family]"
                                   placeholder="Font Family" value="{{old('font_family')}}"
                                   wire:model="officeSettingHeaders.{{$index}}.font_family">
                            @error("officeSettingHeaders.$index.font_family")
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="input-style-1">
                            <label for="font.{{$index}}">Font *</label>
                            <input type="text" id="font.{{$index}}"
                                   name="officeSettingHeaders[{{$index}}][font]"
                                   placeholder="Font" value="{{old('font')}}"
                                   wire:model="officeSettingHeaders.{{$index}}.font">
                            @error("officeSettingHeaders.$index.font")
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="input-style-1">
                            <label for="position.{{$index}}">Position *</label>
                            <input type="text" id="position.{{$index}}"
                                   name="officeSettingHeaders[{{$index}}][position]"
                                   placeholder="Position" value="{{old('position')}}"
                                   wire:model="officeSettingHeaders.{{$index}}.position">
                            @error("officeSettingHeaders.$index.position")
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-1">
                        <div class="input-style-1">
                            <button class="btn btn-danger btn-sm"
                                    wire:click.prevent="removeOfficeSettingHeader({{$index}})">
                                <i class="fa fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    @endforeach
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-sm btn-primary">
                            Submit
                        </button>
                    </div>
                    @endif
                </div>

    </form>


</div>


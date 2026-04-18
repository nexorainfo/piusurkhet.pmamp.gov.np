<div class="row">
    <div class="col-md-6">
        <div class="input-style-1">
            <div class="select-position">
                <label for="menu_type">Menu Type</label>
                <select name="menu_type" wire:model="menu_type" id="menu_type" class="form-control">
                    <option value="">- - छान्नुहोस् - -</option>
                    @foreach (config('menuTypes') as $configMenu)
                        <option value="{{ $configMenu }}">{{ $configMenu }}</option>
                    @endforeach
                </select>
            </div>
            @error('menu_type')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
    </div>
    @if (!empty($menu_type))
        <div class="col-md-6">
            <div class="input-style-1">
                <label for="model_id">{{ $menu_type }}</label>
                <select name="model_id" id="model_id" wire:model="model_id" class="form-control">
                    <option value="">- - छान्नुहोस् - -</option>
                    @foreach ($menuTypes as $menuType)
                        <option value="{{ $menuType->id }}" @if ($menu_type == 'category' && count($menuType->documentCategories) > 0)  @endif>
                            {{ $menuType->title }}
                        </option>

                        @if ($menu_type == 'category')
                            @foreach ($menuType->documentCategories as $documentCategory)
                                <option value="{{ $documentCategory->id }}">&nbsp; - - {{ $documentCategory->title }}
                                </option>
                            @endforeach
                        @endif

                        @if($menu_type == "subordinate")
                        @foreach($menuType->subordinateItems ?? [] as $subordinate)
                            <option value="{{$subordinate->id}}">&nbsp; - - {{$subordinate->title}}</option>
                        @endforeach
                    @endif

                    @endforeach
                </select>
                @error('model_id')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
        </div>
    @endif
</div>

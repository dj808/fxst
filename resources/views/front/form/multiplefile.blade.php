<div class="form-group {!! !$errors->has($errorKey) ?: 'has-error' !!}">

    <label for="{{$id}}" class="col-sm-{{$width['label']}} control-label">{{$label}}</label>

    <div class="col-sm-{{$width['field']}}">

        @include('front::form.error')

        <input type="file" class="{{$class}}" name="{{$name}}[]" {!! $attributes !!} />

        @include('front::form.help-block')

    </div>
</div>

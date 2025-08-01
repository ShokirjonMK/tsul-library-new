<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('locale') }}
            {{ Form::text('locale', $scientificPublicationTranslation->locale, ['class' => 'form-control' . ($errors->has('locale') ? ' is-invalid' : ''), 'placeholder' => 'Locale']) }}
            {!! $errors->first('locale', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('scientific_publication_id') }}
            {{ Form::text('scientific_publication_id', $scientificPublicationTranslation->scientific_publication_id, ['class' => 'form-control' . ($errors->has('scientific_publication_id') ? ' is-invalid' : ''), 'placeholder' => 'Scientific Publication Id']) }}
            {!! $errors->first('scientific_publication_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('title') }}
            {{ Form::text('title', $scientificPublicationTranslation->title, ['class' => 'form-control' . ($errors->has('title') ? ' is-invalid' : ''), 'placeholder' => 'Title']) }}
            {!! $errors->first('title', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('slug') }}
            {{ Form::text('slug', $scientificPublicationTranslation->slug, ['class' => 'form-control' . ($errors->has('slug') ? ' is-invalid' : ''), 'placeholder' => 'Slug']) }}
            {!! $errors->first('slug', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('sub_title') }}
            {{ Form::text('sub_title', $scientificPublicationTranslation->sub_title, ['class' => 'form-control' . ($errors->has('sub_title') ? ' is-invalid' : ''), 'placeholder' => 'Sub Title']) }}
            {!! $errors->first('sub_title', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('country') }}
            {{ Form::text('country', $scientificPublicationTranslation->country, ['class' => 'form-control' . ($errors->has('country') ? ' is-invalid' : ''), 'placeholder' => 'Country']) }}
            {!! $errors->first('country', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('inst_nome_address') }}
            {{ Form::text('inst_nome_address', $scientificPublicationTranslation->inst_nome_address, ['class' => 'form-control' . ($errors->has('inst_nome_address') ? ' is-invalid' : ''), 'placeholder' => 'Inst Nome Address']) }}
            {!! $errors->first('inst_nome_address', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('authors') }}
            {{ Form::text('authors', $scientificPublicationTranslation->authors, ['class' => 'form-control' . ($errors->has('authors') ? ' is-invalid' : ''), 'placeholder' => 'Authors']) }}
            {!! $errors->first('authors', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('keywords') }}
            {{ Form::text('keywords', $scientificPublicationTranslation->keywords, ['class' => 'form-control' . ($errors->has('keywords') ? ' is-invalid' : ''), 'placeholder' => 'Keywords']) }}
            {!! $errors->first('keywords', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('place_protection') }}
            {{ Form::text('place_protection', $scientificPublicationTranslation->place_protection, ['class' => 'form-control' . ($errors->has('place_protection') ? ' is-invalid' : ''), 'placeholder' => 'Place Protection']) }}
            {!! $errors->first('place_protection', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('content') }}
            {{ Form::text('content', $scientificPublicationTranslation->content, ['class' => 'form-control' . ($errors->has('content') ? ' is-invalid' : ''), 'placeholder' => 'Content']) }}
            {!! $errors->first('content', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('description') }}
            {{ Form::text('description', $scientificPublicationTranslation->description, ['class' => 'form-control' . ($errors->has('description') ? ' is-invalid' : ''), 'placeholder' => 'Description']) }}
            {!! $errors->first('description', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
    </div>
</div>

<div>
    {{-- Success is as dangerous as failure. --}}
    <div class="row">
        <div class="col-12">
            <div class="ec-vendor-list card card-default">
                <div class="card-body">
                    <form class="form-horizontal" wire:submit.prevent="courseSelected">
                        <div class="input-group input-group-sm mb-0">
                            <input class="form-control form-control-sm" placeholder="{{ __('Scan or type barcode') }}"
                                id="gtin" wire:model.lazy="gtin" wire:change="courseSelected">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-success">{{ __('Find') }}</button>
                            </div>
                        </div>
                    </form>
                    {{ $gtin }} <br>



                    <div class="card bg-white profile-content">
                        <div class="row">
                            <div class="col-lg-4 col-xl-3">
                                @if ($isUser)
                                    <div class="profile-content-left profile-left-spacing">
                                        <div class="text-center widget-profile px-0 border-0">

                                            <div class="card-img mx-auto rounded-circle">
                                                @if ($user->profile != null && $user->profile->image)
                                                    <img src="/storage/{{ $user->profile->image }}"
                                                        class="img-image" alt="{{ $user->name }}" width="40" />
                                                @else
                                                    <img src="/assets/img/user/user.png" class="user-image"
                                                        alt="{{ $user->name }}" />
                                                @endif
                                            </div>

                                            <div class="card-body">
                                                <h4 class="py-2 text-dark">{{ $user->name }}</h4>
                                                <p>{{ $user->email }}</p>
                                                <div class="form-group">
                                                    <strong>{{ __('Inventar Number') }}:</strong>
                                                    <div>
                                                        @php
                                                            if ($user->inventar_number) {
                                                                $generator = new Picqer\Barcode\BarcodeGeneratorPNG();
                                                                echo '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode($user->inventar_number, $generator::TYPE_CODE_128)) . '">';
                                                            }
                                                        @endphp
                                                        <br>
                                                        {{ $user->inventar_number }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- <div class="d-flex justify-content-between ">
                                                <div class="text-center pb-4">
                                                    <h6 class="text-dark pb-2">546</h6>
                                                    <p>Bought</p>
                                                </div>

                                                <div class="text-center pb-4">
                                                    <h6 class="text-dark pb-2">32</h6>
                                                    <p>Wish List</p>
                                                </div>

                                                <div class="text-center pb-4">
                                                    <h6 class="text-dark pb-2">1150</h6>
                                                    <p>Following</p>
                                                </div>
                                            </div> --}}

                                        <hr class="w-100">

                                        <div class="contact-info pt-4">
                                            @if ($userProfile != null)
                                                <p class="text-dark font-weight-medium pt-24px mb-2">
                                                    {{ __('Phone Number') }}</p>
                                                <p>{{ $userProfile->phone_number }}</p>
                                                <p class="text-dark font-weight-medium pt-24px mb-2">
                                                    {{ __('Date Of Birth') }}</p>
                                                <p>{{ $userProfile->date_of_birth }}</p>
                                                <div class="form-group">
                                                    <strong>{{ __('Course') }}:</strong>
                                                    {{ $userProfile->kursi }}
                                                </div>
                                                <div class="form-group">
                                                    <strong>{{ __('Reference Gender') }}:</strong>
                                                    {!! $userProfile->referenceGender ? $userProfile->referenceGender->title : '' !!}
                                                </div>
                                                <div class="form-group">
                                                    <strong>{{ __('User Type') }}:</strong>
                                                    {!! $userProfile->userType ? $userProfile->userType->title : '' !!}
                                                </div>
                                                <div class="form-group">
                                                    <strong>{{ __('Organization') }}:</strong>
                                                    {!! $userProfile->organization ? $userProfile->organization->title : '' !!}
                                                </div>
                                                <div class="form-group">
                                                    <strong>{{ __('Branch') }}:</strong>
                                                    {!! $userProfile->branch ? $userProfile->branch->title : '' !!}
                                                </div>
                                                <div class="form-group">
                                                    <strong>{{ __('Department') }}:</strong>
                                                    {!! $userProfile->department ? $userProfile->department->title : '' !!}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                            </div>
                            @if ($items != null || ($debtors != null && $debtors->count() > 0))
                                <div class="col-lg-8 col-xl-9">
                                    <div class="profile-content-right profile-right-spacing py-5">
                                        <ul class="nav nav-tabs px-3 px-xl-5 nav-style-border" id="myProfileTab"
                                            role="tablist">
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link active" id="profile-tab" data-bs-toggle="tab"
                                                    data-bs-target="#profile" type="button" role="tab"
                                                    aria-controls="profile"
                                                    aria-selected="true">{{ __('Books') }}</button>
                                            </li>
                                        </ul>
                                        <div class="tab-content px-3 px-xl-5" id="myTabContent">
                                            <div class="tab-pane fade show active" id="profile" role="tabpanel"
                                                aria-labelledby="profile-tab">
                                                <div class="tab-widget mt-5">


                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="ec-vendor-list card card-default">
                                                                @if ($debtors != null && $debtors->count() > 0)
                                                                    <div class="card-body">
                                                                        <div class="float-right">
                                                                            <h4 class="alert alert-primary text-center">
                                                                                {{ __('User indebtedness list') }}
                                                                            </h4>
                                                                        </div>
                                                                        <div class="table-responsive">
                                                                            <table id="responsive-data-table"
                                                                                class="table">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th class="text-center">
                                                                                            {{ __('Dc Title') }}</th>
                                                                                        <th class="text-center">
                                                                                            {{ __('Dc Authors') }}
                                                                                        </th>
                                                                                        <th class="text-center">
                                                                                            {{ __('Inventar Number') }}
                                                                                        </th>
                                                                                        <th class="text-center">
                                                                                            {{ __('How many days do you have to return the book?') }}
                                                                                        </th>
                                                                                        {{-- <th class="text-center">
                                                                                            {{ __('Extension') }}
                                                                                        </th> --}}
                                                                                        <th></th>
                                                                                    </tr>
                                                                                </thead>

                                                                                <tbody>

                                                                                    @foreach ($debtors as $key => $item)
                                                                                     
                                                                                        @if ($item->book_id)
                                                                                            
                                                                                            @php
                                                                                                $today = date('Y-m-d');
                                                                                                // echo $item->return_time;
                                                                                                // $qaytarish_vaqti = strtotime($item->return_time . '- ' . $item->how_many_days . ' days');
                                                                                                // returned time kkmas
                                                                                                $date1 = date_create($item->today);
                                                                                                $date2 = date_create($item->return_time);
                                                                                                $diff = date_diff($date1, $date2);
                                                                                                $day_diff=$diff->format("%R%a");                                                                                   
                                                                                            @endphp
                                                                                        <tr @if ($day_diff<1) class="alert alert-danger" @else class="alert alert-primary" @endif
                                                                                            wire:key="{{ Str::random(30) }}">
                                                                                            <td>
                                                                                                @if ($item->book)
                                                                                                    {{ $item->book->dc_title }}
                                                                                                @endif
                                                                                            </td>
                                                                                            <td>
                                                                                                @if ($item->book)
                                                                                                    @foreach (json_decode($item->book->dc_authors) as $k => $value)
                                                                                                        {!! $value . ',<br>' !!}
                                                                                                    @endforeach
                                                                                                @endif
                                                                                            </td>
                                                                                            <td class="text-center">
                                                                                                    @if ($item->bookInventar != null)
                                                                                                        @if (env('BAR_CODE_TYPE')=='QRCODE')
                                                                                                            {!! QrCode::size(100)->generate($item->bookInventar->bar_code); !!}
                                                                                                        @else
                                                                                                            @php
                                                                                                                $generator = new Picqer\Barcode\BarcodeGeneratorPNG();
                                                                                                                echo '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode($item->bookInventar->bar_code, $generator::TYPE_CODE_128)) . '">';
                                                                                                            @endphp
                                                                                                        @endif
                                                                                                        <br>
                                                                                                        {{ $item->bookInventar->bar_code }}                                                         
                                                                                                    @endif
                                                                                            </td>
                                                                                            <td class="text-center">
                                                                                                
                                                                                                 @if ($day_diff<1)
                                                                                                    {{__("The deadline for submission of books is :attribute days",['attribute' => $diff->format("%a")])}}
                                                                                                @else
                                                                                                    {{__("The deadline is :attribute days",['attribute' => $diff->format("%a")])}}
                                                                                                @endif
                                                                                            </td>
                                                                                            {{-- <td>
                                                                                                <input type="number"
                                                                                                    class="form-control how_many_days"
                                                                                                    placeholder="{{ __('How many days?') }}"
                                                                                                    name="how_many_days"
                                                                                                    id="how_many_days"
                                                                                                    value="10"
                                                                                                    data-cartId="{{ $item->id }}">

                                                                                            </td> --}}
                                                                                            <td>
                                                                                                <button
                                                                                                    class="btn btn-sm btn-warning"
                                                                                                    wire:click.prevent="accept({{ $item->id }})">
                                                                                                    {{ __('Accept the book') }}
                                                                                                </button>
                                                                                            </td>
                                                                                        </tr>
                                                                                        @endif

                                                                                    @endforeach
                                                                                    <tr>
                                                                                        <td colspan="5">
                                                                                            <button
                                                                                                class="btn btn-sm btn-success"
                                                                                                wire:click.prevent="acceptAll">{{ __('Accept it all') }}</button>
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                                @if ($items != null)
                                                                <div class="card-body">
                                                                    <div class="float-right">
                                                                        <button class="btn btn-sm btn-danger"
                                                                            wire:click.prevent="clearAllCart">{{ __('Remove All') }}</button>
                                                                    </div>
                                                                    <div class="table-responsive">
                                                                        <table id="responsive-data-table"
                                                                            class="table">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th class="text-center">
                                                                                        {{ __('Dc Title') }}</th>
                                                                                    <th class="text-center">
                                                                                        {{ __('Dc Authors') }}</th>
                                                                                    <th class="text-center">
                                                                                        {{ __('Inventar Number') }}
                                                                                    </th>
                                                                                    <th class="text-center">
                                                                                        {{ __('How many days is the book given?') }}
                                                                                    </th>
                                                                                    <th class="text-center">
                                                                                        {{ __('Book face image') }}
                                                                                    </th>
                                                                                    <th></th>
                                                                                </tr>
                                                                            </thead>

                                                                            <tbody>
                                                                               
                                                                                @foreach ($items as $key => $item)
                                                                                 
                                                                                    <tr
                                                                                        wire:key="{{ Str::random(30) }}">
                                                                                        <td>

                                                                                            {{ $item['name'] }}
                                                                                        </td>
                                                                                        <td>
                                                                                            @foreach ($item['attributes']['authors'] as $k => $value)
                                                                                                {!! $value . ',<br>' !!}
                                                                                            @endforeach
                                                                                        </td>
                                                                                        <td class="text-center">
                                                                                            
                                                                                            @if (env('BAR_CODE_TYPE')=='QRCODE')
                                                                                                {!! QrCode::size(100)->generate($item['attributes']['gtin']); !!}
                                                                                            @else
                                                                                                @php
                                                                                                    $generator = new Picqer\Barcode\BarcodeGeneratorPNG();
                                                                                                    echo '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode($item['attributes']['gtin'], $generator::TYPE_CODE_128)) . '">';
                                                                                                @endphp
                                                                                            @endif
                                                                                            <br>
                                                                                            {{ $item['attributes']['gtin'] }}
                                                                                        </td>
                                                                                        <td>
                                                                                            <livewire:admin.qarzdorlar.kitob-olish-berish-update :item="$item"
                                                                                            :key="$item['id']" />
                                                                                        </td>
                                                                                        <td>
                                                                                            @if ($item['attributes']['image_path'])
                                                                                                <img src="/storage/{{ $item['attributes']['image_path'] }}"
                                                                                                    alt="{{ $item['attributes']['image_path'] }}"
                                                                                                    width="100px">
                                                                                            @endif
                                                                                        </td>
                                                                                        <td>
                                                                                            <button
                                                                                                class="btn btn-sm btn-danger"
                                                                                                wire:click.prevent="removeCartInput({{ $item['id'] }})">
                                                                                                {{ __('Delete') }}
                                                                                            </button>
                                                                                        </td>
                                                                                    </tr>
                                                                                @endforeach
                                                                                <tr>
                                                                                    <td colspan="5">
                                                                                        <button
                                                                                            class="btn btn-sm btn-success"
                                                                                            wire:click.prevent="saveAllCart">{{ __('Save') }}</button>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        $(document).ready(function() {

            $('.how_many_days').on('change', function(e) {

                let data = $(this).val();
                let cartId = $(this).attr("data-cartId");
                console.log(cartId);
                console.log(data);
                //  @this.set('subjects', data);
                Livewire.emit('updateCartValueToDays', cartId, data);

            });
        });
    </script>
@endpush

<div>

    <footer>
        <div class="border-top space-top-1">
            <div class="border-bottom ">
                <div class="container">
                    <div class="row">
                         @if ($contact !=null && $contact->count()>0)
                            <div class="col-lg-4 mb-6 mb-lg-0">
                                <div class="pb-6">
                                    <a href="/" class="d-inline-block mb-5">
                                        @if ($contact->logo)
                                            <img src="{{ asset('/storage/contacts/logo/' . $contact->logo) }}" style="width: 120px;">
                                        @endif
                                    </a>
                                    <address class="font-size-2 mb-5">
                                        <span class="mb-2 font-weight-normal text-dark">
                                            {!!$contact->street_address!!}
                                        </span>
                                    </address>
                                    <div class="mb-4">
                                        <a href="mailto:{{$contact->email}}"
                                            class="font-size-2 d-block link-black-100 mb-1">{{$contact->email}}</a>
                                        <a href="tel:{{$contact->phone}}" class="font-size-2 d-block link-black-100">{{$contact->phone}}</a>
                                    </div>
                                    <ul class="list-unstyled mb-0 d-flex">
                                        @if ($socials !=null && $socials->count()>0)
                                            @foreach ($socials as $social)
                                                <li class="btn">
                                                    <a class="link-black-100" title="{{$social->title}}" href="{{$social->link}}" target="__blank">
                                                        <span class="fab  {{$social->fa_icon_class}}"></span>
                                                    </a>
                                                </li>        
                                            @endforeach
                                        @endif
    
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-2 mb-6 mb-lg-0">
                                
                            </div>
                            <div class="col-lg-2 mb-6 mb-lg-0">
                                
                            </div>
                            <div class="col-lg-2 mb-6 mb-lg-0">
                                
                            </div>
                            <div class="col-lg-2 mb-6 mb-lg-0">
                                
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="space-1">
                <div class="container">
                    <div class="d-lg-flex text-center text-lg-center justify-content-center align-items-center">
                        <!-- Copyright -->
                        <p class="mb-3 mb-lg-0 font-size-2">©{{date('Y')}} AKBT. All rights reserved</p>
                        <!-- End Copyright -->
                    </div>
                </div>
            </div>
        </div>
    </footer>
   
</div>

<div class="w-full mt-4 mb-10 flex flex-col">
    <div class="py-2 flex-grow flex flex-wrap">
        @foreach ($documents as $i => $document)
            <div class="w-full md:w-1/2 p-2 flex flex-col">
                <div class="flex w-full">
                    <!--div class="bg-grey w-32 h-16 mr-4"> </div-->
                    <div class="w-1/4 mr-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" viewBox="0 0 24 24" style="margin-right: 0.5rem; fill: rgb(0, 148, 125);"><path fill="none" d="M0 0h24v24H0V0z"></path><path d="M14 2H6c-1.1 0-1.99.9-1.99 2L4 20c0 1.1.89 2 1.99 2H18c1.1 0 2-.9 2-2V8l-6-6zM6 20V4h7v5h5v11H6z"></path></svg>
                    </div>
                    <div class="w-3/4 ">
                        <a href="{{route('legal-document.show', ['legalDocument'=>$document])}}" class="no-underline text-grey-dark font-bold text-xs block mb-2">
                            {{$document['name']}}
                        </a>
                        <p class="text-grey-dark text-2xs mb-2">
                            {{$document['created_at']->toDateString()}}
                        </p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<x-app>

    <div class="container pt-2">
        <section class="relative h-72  flex flex-col justify-center align-center text-center space-y-4 mb-4">
            <div class="z-10">
                <div id="animate-me" class="font-bold uppercase text-black ">
                    Welcome {{Auth::user()->first_name}} <span class="text-black"> To Mayalu</span>
                </div>
                <p class="text-2xl text-gray-200 font-bold my-4">
                    Find your partner here
                </p>
                <div>
                    <p class="inline-block border-2 border-white text-white py-2 px-4 rounded-xl uppercase mt-2 hover:text-black hover:border-black">
                        Start searching your lover</p>
                </div>
            </div>
        </section>

        <div class="container mt-4 pt-2 ">
            <div class="row">
                <div class="col-md-8">
                    <!-- Search bar -->
                    <form class="form-inline" method="get" action="/search">

                        <div class="form-row d-flex">
                            <div class="col-md-3 mb-3 pe-2">
                            <label for="username">Search by username</label>
                            <input type="text" class="form-control" id="search" name="username" placeholder="Search by username...">
                            </div>
                            <div class="col-md-3 mb-3 pe-2">
                                <label for="gender">Gender:</label>
                                <select class="form-control" id="gender" name="gender">
                                    <option value="all">All</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                            <div class="col-md-3 mb-3 pe-2 ">
                                <label for="distance">Distance:</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="distance" name="distance" placeholder="Enter distance in km...">
                                    <div class="input-group-append">
                                        <select class="form-control" id="distance" name="distance">
                                            <option value="10">10 km</option>
                                            <option value="15">15 km</option>
                                            <option value="20">20 km</option>
                                            <option value="40">40 km</option>
                                        </select>
                                    </div>
                            </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="age">Age:</label>
                                <div class="input-group">
                                    <select class="form-control" id="age" name="age">
                                        <option value="all">All</option>
                                        <option value="18-20">18-20</option>
                                        <option value="20-25">20-25</option>
                                        <option value="25-30">25-30</option>
                                        <option value="30-40">30-40</option>
                                        <option value="custom">Custom</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2 mb-2 pt-4 ">

                                            <input type="text" class="form-control" id="age-custom" name="age-custom" placeholder="Enter age range...">
                                        </div>
                            <div class="col-md-3 mb-3 pt-4 px-2">
                                <button type="submit" class="btn btn-secondary">Search</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
{{$slot}}

    </div>
</x-app>


























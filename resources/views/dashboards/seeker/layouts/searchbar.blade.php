<div class="container">
    <form action="{{ route('seeker.all-properties') }}" method="GET" role="search">
        @csrf
        <div class="card shadow-sm">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-2">
                      <!-- text input -->
                      <div class="form-group">
                        <input type="text" class="form-control" name="address" value="{{ request()->input('address') }}" placeholder="St., City, Province">
                      </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <select name="category" class="browser-default custom-select" >
                                <option value="" disabled selected>Category</option>
                                <option value="apartment">Apartment</option>
                                <option value="condo">Condo</option>
                                <option value="house">House</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <select name="type" class="browser-default custom-select">
                                <option value="" disabled selected>Type</option>
                                <option value="rent">Rent</option>
                                <option value="sale">Sale</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <input type="number" name="minprice" id="minprice" class="form-control" value="{{ request()->input('minprice') }}" placeholder="Min Price">
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <input type="number" name="maxprice" id="maxprice" class="form-control" value="{{ request()->input('maxprice') }}" placeholder="Max Price">
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary"><b><i class="fas fa-search"></i>&nbsp;S E A R C H</b></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
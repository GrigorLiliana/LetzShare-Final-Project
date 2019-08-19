<div class="filters form-group">
    <form action="" method="GET">
        <div class="form-group form-inline">
            <input class="form-control mr-sm-2 form-control-sm" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </div>
        <div class="form-row">
            <div class="form-group col-md-2">
                <label for="photo-user">Photographers</label>
                <select class="form-control form-control-sm" name="users" id="users" required>
                    <option value="" disabled>Select</option>
                    @foreach ($users as $user)
                    <option value="{{$users->user_id}}">{{$users->user_name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-2">
                <label for="photo-user">Location</label>
                <select class="form-control form-control-sm" name="locality" id="locality" required>
                    <option value="" disabled>Select</option>
                    @foreach ($locations as $locality)
                    <option value="{{$locality->locality_id}}">{{$locality->locality_name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-2">
                <label for="photo-user">Category</label>
                <select class="form-control form-control-sm" name="category" id="category" required>
                    <option value="" disabled>Select</option>
                    @foreach ($categories as $category)
                    <option value="{{$category->category_id}}">{{$category->category_name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-2">
                <label for="photo-user">Likes</label>
                <select class="form-control form-control-sm" name="likes" id="likes_sum" required>
                    <option value="" disabled>Select</option>
                    @foreach ($likes as $like)
                    <option value="{{$likes->likes_id}}">{{$likes->likes_sum}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-sm-4">
                <label for="photo-user">Date</label>
                <select class="form-control form-control-sm">
                    <option>select</option>
                    <option>A-Z</option>
                </select>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
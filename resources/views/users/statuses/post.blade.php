<div class="message ">                            
        <div class="message-body">
            <form action="{{route('statuses.store')}}" method="POST">
                {{csrf_field()}}
                @if(isset($profileOwner))
                    <input type="hidden" name="profileOwner" value="{{$profileOwner}}">
                @endif
                <textarea class="textarea mb-1" name="body" placeholder="Whats on your mind...?" required></textarea> 
                <div class="columns">
                    <div class="file column is-primary  is-4">
                        <label class="file-label">
                            <input class="file-input" type="file" name="image">
                                <span class="file-cta">
                                    <span class="file-icon">
                                        <i class="fa fa-upload"></i>
                                    </span>
                                <span class="file-label">
                                    Upload Picture...
                                </span>
                            </span>
                        </label>
                    </div>
                    <div class="column  is-5">
                            <div class="control has-icons-left">
                                    <div class="select">
                                      <select class="is-focused" name="mood">
                                        <option selected value="1">Select Your Mood</option>
                                        @foreach($moods as $mood)
                                            <option value="{{$mood->id}}">{{$mood->name}}</option>
                                        @endforeach
                                      </select>
                                    </div>
                                    <span class="icon is-medium is-left">
                                      <i class="fa fa-heart"></i>
                                    </span>
                                  </div>
                    </div>
                    <div class="column">
                        <button type="submit" class="button is-link">Post Status...</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
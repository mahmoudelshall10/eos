<h1 class="text-center">{{$project->name}}</h1>
<p><strong> Description : </strong>{{$project->description}}</p>

<table id="dynamic-table" class="table">
    <thead>
        <tr>
            <th>All Files</th>
        </tr>
    </thead>
    <tbody>
        @foreach($project->files as $file)
            <tr>
                <td>
                    <a href="{{route('download',$file->uuid)}}">{{$file->name}}</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>




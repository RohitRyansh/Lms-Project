    @foreach ($deployments as $deployment)
        {{ $deployment->commit_hash }}
    @endforeach

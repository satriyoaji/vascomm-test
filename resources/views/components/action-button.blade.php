<div class="pr-1">
@isset($updateable)
    @if($updateable == 'button')
        <button class="{{ $editButtonClass ?? 'editBtn' }} btn btn-sm btn-outline btn-primary ml-1" value="{{$updateValue}}" data-toggle="tooltip" title="Update">
            <i class="fa fa-edit"></i></button>
    @elseif($updateable == 'a')
        <a href="{{$href}}" class="edit btn btn-sm btn-outline btn-primary ml-1" data-toggle="tooltip" title="Update">
            <i class="fa fa-edit"></i></a>
    @endif
@endisset

@isset($donationable)
    @if($donationable == 'button')
        <button class="{{ $donationButtonClass ?? 'donationBtn' }} btn btn-sm btn-outline btn-primary ml-1" value="{{$donationValue}}" data-toggle="tooltip" title="Donasi">
            <i class="fa fa-money"></i></button>
    @elseif($donationable == 'a')
        <a href="{{$href}}" class="edit btn btn-sm btn-outline btn-primary ml-1" data-toggle="tooltip" title="Donasi">
            <i class="fa fa-money"></i></a>
    @endif
@endisset

@isset($showable)
    @if($showable == 'button')
        <button class="{{ $showButtonClass ?? 'showBtn' }} btn btn-sm btn-outline btn-warning mr-3" value="{{$showValue}}" data-toggle="tooltip" title="Detail">
            <i class="fa fa-info"></i></button>
    @elseif($showable == 'a')
        <a href="{{$href}}" class="edit btn btn-sm btn-outline btn-warning mr-3" data-toggle="tooltip" title="Detail">
            <i class="fa fa-info"></i></a>
    @endif
@endisset

@isset($deleteable)
    <button type="button" name="delete" class="{{ $deleteButtonClass ?? 'deleteBtn' }} btn btn-sm btn-outline btn-danger pr-2" data-toggle="tooltip" title="Delete"
    value="{{(isset($deleteId) ? $deleteId : '')}}">
        <i class="fa fa-trash"></i>
    </button>
@endisset

@isset($printable)

@endisset

@isset($approvable)
    <button type="button" class="approveBtn btn btn-sm btn-success ml-1" data-toggle="tooltip" title="Approve {{$approveStatus}}"
            value="{{$approveValue}}"><i class="fa fa-check-circle"></i></button>
@endisset

</div>

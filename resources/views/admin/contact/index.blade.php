@extends('layouts.admin')

@section('content')
    <h1>Contact Messages</h1>
    <div class="messages-container">
        @foreach($contacts as $contact)
        <div class="message-card card mb-3">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start">
                    <div class="message-preview">
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <h5 class="message-sender mb-0">{{ $contact->name }}</h5>
                            <small class="text-muted">&lt;{{ $contact->email }}&gt;</small>
                        </div>
                        <div class="d-flex align-items-center gap-3">
                            <h6 class="message-subject mb-0">{{ $contact->subject }}</h6>
                            <span class="text-muted message-excerpt">
                                - {{ Str::limit($contact->message, 80) }}
                            </span>
                        </div>
                    </div>
                    <div class="message-meta">
                        <small class="text-muted">{{ $contact->created_at->diffForHumans() }}</small>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-transparent d-flex gap-2">
                <a href="{{ route('contact.edit', $contact->id) }}" class="btn btn-sm btn-outline-primary">
                    <i class="bi bi-pencil"></i> Edit
                </a>
                <form action="{{ route('contact.destroy', $contact->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-outline-danger" 
                            onclick="return confirm('Are you sure?')">
                        <i class="bi bi-trash"></i> Delete
                    </button>
                </form>
            </div>
        </div>
        @endforeach
    </div>

    <style>
        .message-card {
            transition: all 0.2s ease;
            border-left: 4px solid transparent;
        }
        
        .message-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            border-left-color: #0d6efd;
        }
        
        .message-sender {
            font-weight: 600;
            color: #1a1a1a;
        }
        
        .message-subject {
            color: #333;
        }
        
        .message-excerpt {
            font-size: 0.9em;
            color: #666;
        }
        
        .message-meta {
            min-width: 100px;
            text-align: right;
        }
    </style>
@endsection
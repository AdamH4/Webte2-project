<?php

namespace App\Events;

use App\Models\Exam;
use App\Models\Student;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ExamEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    protected $exam;
    protected $student;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Exam $exam, Student $student)
    {
        $this->exam = $exam;
        $this->student = $student;
    }

    /**
     * The event's broadcast name.
     *
     * @return string
     */
    public function broadcastAs()
    {
        return 'Exam';
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('Exam.' . $this->student->ais_id . '.' . $this->exam->code);
    }

    public function broadcastWith()
    {
        return [
            'student' => $this->student,
            'exam' => $this->exam
        ];
    }
}

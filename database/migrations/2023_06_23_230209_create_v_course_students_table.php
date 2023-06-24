<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement($this->createView());
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement($this->dropView());
    }

    private function createView(): string
    {
        return "CREATE VIEW v_course_student AS
                SELECT
                    cs.id,
                    cs.student_id ,
                    s.name ,
                    s.last_name ,
                    cs.course_id ,
                    c.name name_course,
                    cs.created_at ,
                    cs.updated_at
                FROM
                    course_student cs ,
                    students s ,
                    courses c
                WHERE
                    cs.student_id = s.id
                    AND cs.course_id = c.id";
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    private function dropView(): string
    {
        return "DROP VIEW IF EXISTS `v_course_student`";
    }
};

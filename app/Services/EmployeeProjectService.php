<?php

namespace App\Services;

use App\Models\EmployeeProject;
use Carbon\Carbon;

class EmployeeProjectService
{

    public function storeProjects(array $fileData)
    {
        foreach ($fileData as $row) {
            $dateFrom = $this->getEffectiveDate($row[2]);
            $dateTo = $this->getEffectiveDate($row[3]);

            EmployeeProject::create([
                'emp_id' => $row[0],
                'project_id' => $row[1],
                'date_from' => $dateFrom,
                'date_to' => $dateTo ?? now(),
            ]);

        }
    }

    public function getEffectiveDate($date)
    {
            try {

                return Carbon::parse($date);

            } catch (\Exception $e) {

                return now();

            }

    }

    public function calculateOverlapDays(EmployeeProject $project1, EmployeeProject $project2)
    {

        $dateFrom1 = $this->getEffectiveDate($project1->date_from);
        $dateFrom2 = $this->getEffectiveDate($project2->date_from);
        $dateTo1 = $this->getEffectiveDate($project1->date_to);
        $dateTo2 = $this->getEffectiveDate($project2->date_to);

        $start = $dateFrom1->greaterThan($dateFrom2) ? $dateFrom1 : $dateFrom2;

        $end = $dateTo1->lessThan($dateTo2) ? $dateTo1 : $dateTo2;

        return $start->lessThanOrEqualTo($end) ? $start->diffInDays($end) : 0;
    }

    public function populateTableData()
    {

        $pairs = collect();
        $projects = EmployeeProject::all();

        foreach ($projects as $key => $project) {

            foreach ($projects as $other) {

                if ($project->emp_id == $other->emp_id || $project->project_id != $other->project_id) {
                    continue;
                }

                $daysWorked = $this->calculateOverlapDays($project, $other);


                if ($daysWorked > 0) {

                    $employees = [$project->emp_id, $other->emp_id];
                    sort($employees);

                    $pairs->push((object)[
                        'emp1' => $employees[0],
                        'emp2' => $employees[1],
                        'project_id' => $project->project_id,
                        'days_worked' => $daysWorked
                    ]);
                }
            }

            $projects->forget($key);
        }

        $pairs = $pairs->sortByDesc('days_worked');
        return $pairs;

    }

}

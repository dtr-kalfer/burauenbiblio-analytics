<?php
	/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
	 * See the file COPYRIGHT.html for more details. --F.Tumulak
	 */
	
	namespace LibraryAttendance;

	class Attendance extends \ConnectDB { //use backslash (// root namespace if ConnectDB has no namespace)

			public function getRangeAttendance($start_date, $end_date, $isStudentsOnly = false) {
					$sql = "
							SELECT 
									user_type,
									course,
									DATE_FORMAT(date, '%Y-%m') AS month,
									SUM(count) AS total
							FROM library_attendance
							WHERE date BETWEEN ? AND ?
					";

					// Add optional filter
					if ($isStudentsOnly) {
							$sql .= " AND user_type = 'Student'";
					}

					$sql .= "
							GROUP BY user_type, course, month
							ORDER BY month ASC
					";

					// Use the protected select() from ConnectDB
					$stmt = $this->select($sql, "ss", [$start_date, $end_date]); 
					return $stmt ? $stmt : [];
			}

			public function getListCourses() {
					$rows = $this->select("
							SELECT DISTINCT course
							FROM library_attendance
							WHERE user_type = 'Student'
								AND course IS NOT NULL
								AND course <> ''
							ORDER BY course ASC
					");

					return array_map(fn($row) => $row['course'], $rows);

			}
}

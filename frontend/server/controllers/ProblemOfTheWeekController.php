<?php

/**
 *  ProblemOfTheWeekController
 *
 */
class ProblemOfTheWeekController extends Controller {
    const MAX_REQUEST_SIZE = 1000;

    /**
     * Returns the problem of the week with the latest date there is in the table.
     */
    public static function apiGetLastProblemOfTheWeek(Request $r) {
        return [
          'status' => 'ok',
          'results' => self::getListOfProblemsOfTheWeek(/*offset=*/ 0, /*rowcount=*/ 1)[0],
        ];
    }

    /**
     * Returns the last 'rowcount' problems of the week from newest to oldest.
     */
    public static function apiGetListOfProblemsOfTheWeek(Request $r) {
        if ($r['rowcount'] > self::MAX_REQUEST_SIZE) {
            throw new InvalidDatabaseOperationException($e);
        }
        Validators::isNumber($r['offset'], "offset", /* $required= */ true);
        Validators::isNumber($r['rowcount'], "rowcount", /* $required= */ true);

        $results = self::getListOfProblemsOfTheWeek(intval($r['offset']), intval($r['rowcount']));
        return [
            'status' => 'ok',
            'results' => $results,
            'total' => count($results),
        ];
    }

    private static function getListOfProblemsOfTheWeek($offset, $rowcount) {
        $results = [];
        Cache::getFromCacheOrSet(
            Cache::PROBLEM_OF_THE_WEEK,
            $offset . '-' . $rowcount,
            array($offset, $rowcount),
            'ProblemOfTheWeekController::getListOfProblemsOfTheWeekImpl',
            $results,
            APC_USER_CACHE_PROBLEMS_OF_THE_WEEK_TIMEOUT
        );
        return $results;
    }

    // Made public to be cacheable.
    public static function getListOfProblemsOfTheWeekImpl($offset, $rowcount) {
        return ProblemOfTheWeekDAO::getListOfProblemsOfTheWeek($offset, $rowcount);
    }
}

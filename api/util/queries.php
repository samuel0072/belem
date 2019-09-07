<?php
function find_by_criteria($critName, $critValue, $table, $type, $columns) {
    global $response, $db, $queryBuilder;
    prepare();
    $queryBuilder->select(["*"])->from($table)->where(" $critName = ?");
    $stm = $db->prepare($queryBuilder->get_query());
    $stm->bind_param($type, $critValue);
    if($stm->execute()) {
        $result = array();
        foreach($columns as $key => $value) {
            $result[$key] = [];
        }
        $stm->bind_result(...$result);

        while($stm->fetch()) {
            foreach ($result as $key => $value) {
                $result[$columns[$key]] = $key;
                unset($result[$key]);
            }
            $response->ok($result);
        }
    }
    else{
        $response->error([$db->get_error(), "ops houve algum erro"]);
    }

    return json_encode($response);
}
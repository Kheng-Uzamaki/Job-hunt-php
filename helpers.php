<?php

/**
 * Get Base Path
 * 
 * @param string $path
 * 
 * @return string
 */
function basePath($path = '')
{
    return __DIR__ . '/' . $path;
}


/**
 * Load a view
 * 
 * @param string $name
 * @return void
 * 
 * 
 */
function loadView($name, $data = [])
{
    $viewPath = basePath("App/views/{$name}.view.php");

    if (file_exists($viewPath)) {
        extract($data);
        require $viewPath;
    } else {
        echo "View not found: {$name}";
        exit;
    }
}

/**
 * Load a partial
 * 
 * @param string $name
 * @return void
 * 
 * 
 */
function loadPartial($name)
{
    $partialPath = basePath("App/views/partials/{$name}.php");

    if (file_exists($partialPath)) {
        require $partialPath;
    } else {
        echo "View not found: {$name}";
        exit;
    }
}


/**
 * inspect a value(s)
 * 
 * @param mixed $value
 * @return void
 */

function inspect($value)
{
    echo "<pre>";
    var_dump($value);
    echo "</pre>";
}


/**
 * inspect a value(s) and die
 * 
 * @param mixed $value
 * @return void
 */

function inspectAndDie($value)
{
    echo "<pre>";
    die(var_dump($value));
    echo "</pre>";
}


/**
 * Format salary
 * 
 * @param string $salary
 * @return string $formatted Salary
 */

function formatSalary($salary)
{
    return '$' . number_format(floatval($salary));
}

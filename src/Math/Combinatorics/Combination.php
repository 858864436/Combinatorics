<?php /** @copyright Alejandro Salazar (c) 2016 */
namespace Math\Combinatorics;

use \Math\Combinatorics\Combination\Pointer;

/******************************************* Disclaimer ********************************************
 * This class is based on the efforts of David Sanders <shangxiao@php.net>, author of the 
 * Combinatorics PEAR package.
 * 
 * You can see his original source at https://pear.php.net/package/Math_Combinatorics
 **************************************************************************************************/

/**
 * The <kbd>Combination</kbd> class provides the Math functionality to calculate a list of combinations
 * given a supplied set of data.
 * <p>It provides with an instance approach and static methods to use it without the need to 
 * explicitly create an instance.</p>
 *
 * @author     Alejandro Salazar (alphazygma@gmail.com)
 * @category   Math
 * @version    1.0
 * @license    http://www.gnu.org/licenses/lgpl-3.0.en.html GNU LGPLv3
 * @link       https://github.com/alphazygma/Combinatorics
 * @package    Math
 * @subpackage Combinatorics
 */
class Combination
{
    /**
     * Creates all the possible combinations for the source data set.
     * <p>Static method allows to use the functionality as a utility rather than as an instance 
     * approach.</p>
     * 
     * @param array $sourceDataSet The source data from which to calculate combiantions.
     * @param int   $subsetSize    (Optional)<br/>If supplied, only combinations of the indicated
     *      size will be returned.
     *      <p>If the subset size is greater than the source data set size, only one combination will
     *      be returned which includes all the elements in the source data set.</p>
     *      <p>If the subset size is less or equal to 0, only one combination will be returned with
     *      no elements.</p>
     * @return array A list of arrays containing all the combinations from the source data set.
     */
    public static function get(array $sourceDataSet, $subsetSize = null)
    {
        $combination = new static($sourceDataSet, $subsetSize);
        return $combination->getCombinations($sourceDataSet, $subsetSize);
    }
    
    /**
     * Creates all the possible combinations for the source data set.
     * 
     * @param array $sourceDataSet The source data from which to calculate combiantions.
     * @param int   $subsetSize    (Optional)<br/>If supplied, only combinations of the indicated
     *      size will be returned.
     *      <p>If the subset size is greater than the source data set size, only one combination will
     *      be returned which includes all the elements in the source data set.</p>
     *      <p>If the subset size is less or equal to 0, only one combination will be returned with
     *      no elements.</p>
     * @return array A list of arrays containing all the combinations from the source data set.
     */
    public function getCombinations(array $sourceDataSet, $subsetSize = null)
    {
        // If the subset size is supplied, then just return the combinations that match such size
        if (isset($subsetSize)) {
            return $this->_getCombinationSubset($sourceDataSet, $subsetSize);
        }
        
        // Otherwise, we return all possible combinations
        $masterCombinationSet = [];
        
        // Calculate the combinations for all the possible lengths and add them to the master set
        $sourceDataSetLength = count($sourceDataSet);
        for ($i = 1; $i <= $sourceDataSetLength; $i++) {
            $combinationSubset    = $this->_getCombinationSubset($sourceDataSet, $i);
            $masterCombinationSet = array_merge($masterCombinationSet, $combinationSubset);
        }
        
        return $masterCombinationSet;
    }
    
    /**
     * Calculates all the combinations of a given subset size.
     * @param array $sourceDataSet The source data from which to calculate combiantions.
     * @param int   $subsetSize    Size of the combinations to calculate
     * @return array
     * @throws \InvalidArgumentException if the subset size is not supplied
     */
    protected function _getCombinationSubset(array $sourceDataSet, $subsetSize)
    {
        if (!isset($subsetSize) || $subsetSize < 0) {
            throw new \InvalidArgumentException('Subset size cannot be empty or less than 0');
        }
        
        $sourceSetSize = count($sourceDataSet);

        if ($subsetSize >= $sourceSetSize) {
            return [$sourceDataSet];
            
        } else if ($subsetSize == 1) {
            return array_chunk($sourceDataSet, 1, true);
            
        } else if ($subsetSize == 0) {
            return [];
        }

        $combinations = [];
        $setKeys      = array_keys($sourceDataSet);

        $pointer = new Pointer($sourceDataSet, $subsetSize);

        do {
            $combinations[] = $this->_getCombination($sourceDataSet, $setKeys, $pointer);
        } while ($pointer->advance());

        return $combinations;
    }
    
    /**
     * Get the combination for the current pointer positions.
     * @param array $sourceDataSet The source data set.
     * @param array $setKeyList    The keys of the source data set.<br/>These can be calculated off
     *      of the source data set, however, for performance optimization, this value can be
     *      calculated once outside this method and thus no more memory needs to be initialized
     *      to temporarily store this keys.
     * @param \Math\Set\Combination\Pointer $pointer Object that represents the indexes to
     *      be used for the current combination
     * @return array A list of elements representing the combination given by the current pointers.
     */
    private function _getCombination($sourceDataSet, $setKeyList, Pointer $pointer)
    {
        $combination = array();

        $indexPointerList = $pointer->getPointerList();
        foreach ($indexPointerList as $indexPointer) {
            $namedKey = $setKeyList[$indexPointer];
            
            $combination[$namedKey] = $sourceDataSet[$namedKey];
        }

        return $combination;
    }
}

<?php /** @copyright Alejandro Salazar (c) 2016 */
namespace Math\Combinatorics\Combination;

/******************************************* Disclaimer ********************************************
 * This class is based on the efforts of David Sanders <shangxiao@php.net>, author of the 
 * Combinatorics PEAR package.
 * 
 * You can see his original source at https://pear.php.net/package/Math_Combinatorics
 **************************************************************************************************/

/**
 * The <kbd>Pointer</kbd> class handles pointer stepping to calculate the subsets, but detach the 
 * pointer behavior from the Combination class.
 * <p>This helps by allowing to make multiple Combination calculations in a multi-threaded enviornment
 * without having each of the method calls interfere with each other because the pointers are stored
 * as an instance variable.</p>
 * <p>It also abstracts the parameters that need to be passed for advancing pointers from the 
 * combination logic code.</p>
 *
 * @author     Alejandro Salazar (alphazygma@gmail.com)
 * @category   Math
 * @version    1.0
 * @license    http://www.gnu.org/licenses/lgpl-3.0.en.html GNU LGPLv3
 * @link       https://github.com/alphazygma/Math
 * @package    Math
 * @subpackage Combinatorics
 */
class Pointer
{
    /** @var array */
    private $_indexPointerList;
    /** @var int */
    private $_sourceSetMaxIndex;
    /** @var int */
    private $_subsetMaxIndex;
    
    /**
     * Creates a new pointer handler for the supplied source data set to move pointers based on the
     * supplied subset size.
     * @param array $sourceDataSet
     * @param int   $subsetSize
     */
    public function __construct($sourceDataSet, $subsetSize)
    {
        // The first retrieved keys could be either named or numberical, since we don't know, we
        // assume that they are named
        $namedKeyList = array_keys($sourceDataSet);
        
        // We extrac the keys from the $namedKeys array which will give us the positional keys
        // If the source data set had positional keys, then $positionalKeys will be equal to $namedKeys
        $positionalKeyList = array_keys($namedKeyList);
        
        $this->_indexPointerList  = array_slice($positionalKeyList, 0, $subsetSize);
        $this->_sourceSetMaxIndex = count($sourceDataSet) - 1;
        $this->_subsetMaxIndex    = $subsetSize - 1;
    }
    
    /**
     * Returns a list of pointers to the positional keys of the Source Data Set keys which are to
     * be used for this iteration.
     * @return int[]
     */
    public function getPointerList()
    {
        return $this->_indexPointerList;
    }
    
    /**
     * Moves the pointers to collect the new elements to use for this subset iteration
     * @return type
     */
    public function advance()
    {
        return $this->_advanceDelegate($this->_subsetMaxIndex, $this->_sourceSetMaxIndex);
    }
    
    /**
     * Helper method to advance the positional indexes in the pointer list for the iteration next 
     * elements to calculate substets
     * <p>This method uses recursion to move all the indexes in the pointer list</P>
     * 
     * @param int $subsetLastIndex
     * @param int $workingSetMaxIndex
     * @return boolean
     */
    private function _advanceDelegate($subsetLastIndex, $workingSetMaxIndex)
    {
        // Exit condition, if the supplied last index falls back from the first subset index (basically
        // due to a recursion call), then we have gone back as far possible
        if ($subsetLastIndex < 0) {
            return false;
        }

        // If the last index pointer points to an index that is less than the Max index on the 
        // working set, then we can safely move the index pointer one position closer to the end
        // of the working set
        if ($this->_indexPointerList[$subsetLastIndex] < $workingSetMaxIndex) {
            $this->_indexPointerList[$subsetLastIndex]++;
            return true;
        }
        
        // Otherwise, the last index poiner is already pointing to the end of the working set
        // so we need to check we can move the pointer of whichever index the previous pointer is
        // pointing to
        $subsetSecondLastIndex  = $subsetLastIndex - 1;
        $reducedWorkingMaxIndex = $workingSetMaxIndex - 1;

        // We do the check, by recursively calling this method, with a new set of indexes.
        if ($this->_advanceDelegate($subsetSecondLastIndex, $reducedWorkingMaxIndex)) {
            // If the second last index could be moved, then we need to set the current pointer to point
            // to the index following the second last that was just calculated (by the recursion call)
            $this->_indexPointerList[$subsetLastIndex] = $this->_indexPointerList[$subsetSecondLastIndex] + 1;
            return true;
        }
        
        // Otherwise the second to last index could not be moved so we ran out of combinations.
        return false;
    }
}

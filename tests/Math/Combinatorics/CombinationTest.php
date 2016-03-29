<?php /** @copyright Alejandro Salazar (c) 2016 */
namespace Math\Combinatorics;

/**
 * The <kbd>CombinationTest</kbd> test suite for the <kbd>Combination</kbd> class.
 *
 * @author     Alejandro Salazar (alphazygma@gmail.com)
 * @category   Math
 * @version    1.0
 * @license    http://www.gnu.org/licenses/lgpl-3.0.en.html GNU LGPLv3
 * @link       https://github.com/alphazygma/Math
 * @package    Math
 * @subpackage Combinatorics
 */
class CombinationTest extends \PHPUnit_Framework_TestCase
{
    private $_sourceDataSetKey = ['a' => 5, 'b' => 6, 'c' => 8, 'd' => 10];
    private $_sourceDataSetIdx = [5, 6, 8, 10];
    
    public function testCombinationsInstance()
    {
        $mathCombination = new Combination();
        
        // Size 0 combinations ---------------------------------------------------------------------
        $combinationList0 = $mathCombination->getCombinations($this->_sourceDataSetKey, 0);
        $expectedList0    = [];
        $this->_assertCombination($combinationList0, $expectedList0, 0);
        
        
        // Size 1 combinations ---------------------------------------------------------------------
        $combinationList1 = $mathCombination->getCombinations($this->_sourceDataSetKey, 1);
        $expectedList1 = [
            ['a' => 5], ['b' => 6], ['c' => 8], ['d' => 10]
        ];
        $this->_assertCombination($combinationList1, $expectedList1, 4, 1);
        
        // If this test pass, we don't need to check for other Index arrays as it proves that the
        // combination is still treated as a map and thus if the key arrays tests pass, so would the
        // indexed arrays
        $combinationIdxList1 = $mathCombination->getCombinations($this->_sourceDataSetIdx, 1);
        $expectedIdxList1 = [
            [0 => 5], [1 => 6], [2 => 8], [3 => 10]
        ];
        $this->_assertCombination($combinationIdxList1, $expectedIdxList1, 4, 1);
        
        
        // Size 3 combinations ---------------------------------------------------------------------
        $combinationList3 = $mathCombination->getCombinations($this->_sourceDataSetKey, 3);
        $expectedList3 = [
            ['a' => 5, 'b' => 6, 'c' => 8],
            ['a' => 5, 'b' => 6, 'd' => 10],
            ['a' => 5, 'c' => 8, 'd' => 10],
            ['b' => 6, 'c' => 8, 'd' => 10],
        ];
        $this->_assertCombination($expectedList3, $combinationList3, 4, 3);
        
        
        // Size 4 combinations ---------------------------------------------------------------------
        $combinationList4 = $mathCombination->getCombinations($this->_sourceDataSetKey, 4);
        $expectedList4 = [
            ['a' => 5, 'b' => 6, 'c' => 8, 'd' => 10],
        ];
        $this->_assertCombination($expectedList4, $combinationList4, 1, 4);
        
        
        // All combinations ------------------------------------------------------------------------
        $combinationList = $mathCombination->getCombinations($this->_sourceDataSetKey);
        $expectedList = [
            ['a' => 5], ['b' => 6], ['c' => 8], ['d' => 10],
            ['a' => 5, 'b' => 6],  ['a' => 5, 'c' => 8], 
            ['a' => 5, 'd' => 10], ['b' => 6, 'c' => 8], 
            ['b' => 6, 'd' => 10], ['c' => 8, 'd' => 10], 
            ['a' => 5, 'b' => 6, 'c' => 8],
            ['a' => 5, 'b' => 6, 'd' => 10],
            ['a' => 5, 'c' => 8, 'd' => 10],
            ['b' => 6, 'c' => 8, 'd' => 10],
            ['a' => 5, 'b' => 6, 'c' => 8, 'd' => 10],
        ];
        $this->_assertCombination($expectedList, $combinationList, 15);
    }
    
    public function testCombinationsStatic()
    {
        // Size 0 combinations ---------------------------------------------------------------------
        $combinationList0 = Combination::get($this->_sourceDataSetKey, 0);
        $expectedList0    = [];
        $this->_assertCombination($combinationList0, $expectedList0, 0);
        
        
        // Size 1 combinations ---------------------------------------------------------------------
        $combinationList1 = Combination::get($this->_sourceDataSetKey, 1);
        $expectedList1 = [
            ['a' => 5], ['b' => 6], ['c' => 8], ['d' => 10]
        ];
        $this->_assertCombination($combinationList1, $expectedList1, 4, 1);
        
        // If this test pass, we don't need to check for other Index arrays as it proves that the
        // combination is still treated as a map and thus if the key arrays tests pass, so would the
        // indexed arrays
        $combinationIdxList1 = Combination::get($this->_sourceDataSetIdx, 1);
        $expectedIdxList1 = [
            [0 => 5], [1 => 6], [2 => 8], [3 => 10]
        ];
        $this->_assertCombination($combinationIdxList1, $expectedIdxList1, 4, 1);
        
        
        // Size 3 combinations ---------------------------------------------------------------------
        $combinationList3 = Combination::get($this->_sourceDataSetKey, 3);
        $expectedList3 = [
            ['a' => 5, 'b' => 6, 'c' => 8],
            ['a' => 5, 'b' => 6, 'd' => 10],
            ['a' => 5, 'c' => 8, 'd' => 10],
            ['b' => 6, 'c' => 8, 'd' => 10],
        ];
        $this->_assertCombination($expectedList3, $combinationList3, 4, 3);
        
        
        // Size 4 combinations ---------------------------------------------------------------------
        $combinationList4 = Combination::get($this->_sourceDataSetKey, 4);
        $expectedList4 = [
            ['a' => 5, 'b' => 6, 'c' => 8, 'd' => 10],
        ];
        $this->_assertCombination($expectedList4, $combinationList4, 1, 4);
        
        
        // Size 3 combinations ---------------------------------------------------------------------
        $combinationList = Combination::get($this->_sourceDataSetKey);
        $expectedList = [
            ['a' => 5], ['b' => 6], ['c' => 8], ['d' => 10],
            ['a' => 5, 'b' => 6],  ['a' => 5, 'c' => 8], 
            ['a' => 5, 'd' => 10], ['b' => 6, 'c' => 8], 
            ['b' => 6, 'd' => 10], ['c' => 8, 'd' => 10], 
            ['a' => 5, 'b' => 6, 'c' => 8],
            ['a' => 5, 'b' => 6, 'd' => 10],
            ['a' => 5, 'c' => 8, 'd' => 10],
            ['b' => 6, 'c' => 8, 'd' => 10],
            ['a' => 5, 'b' => 6, 'c' => 8, 'd' => 10],
        ];
        $this->_assertCombination($expectedList, $combinationList, 15);
    }
    
    private function _assertCombination(
            $combinationList, $expectedCombinationList, $expectedCount, $expectedSize = null)
    {
        // There should be N combinations
        $this->assertCount($expectedCount, $combinationList);
        // If the expected size is supplied, every combination should be of the expected size
        if (isset($expectedSize)) {
            foreach ($combinationList as $combination) {
                $this->assertCount($expectedSize, $combination);
            }
        }
        
        foreach ($expectedCombinationList as $index => $expectedCombination) {
            // The comparison should also be done in the same order
            $compareCombination = $combinationList[$index];
            
            foreach ($expectedCombination as $expectedKey => $expectedValue) {
                $compareKey   = key($compareCombination);
                $compareValue = current($compareCombination);

                $this->assertEquals($expectedKey, $compareKey);
                $this->assertEquals($expectedValue, $compareValue);
                
                // advancing the pointer on the compare combination as well
                next($compareCombination);
            }
            
            reset($compareCombination);
        }
    }
}

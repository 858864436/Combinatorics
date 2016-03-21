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
    private $_sourceDataSet = ['a' => 5, 'b' => 6, 'c' => 8, 'd' => 10];
    
    public function testCombinationsInstance()
    {
        $mathCombination = new Combination();
        
        // Size 1 combinations ---------------------------------------------------------------------
        $combinationList1 = $mathCombination->getCombinations($this->_sourceDataSet, 1);
        $expectedList1 = [
            
        ];
        $this->_assertCombination($combinationList1, $expectedList1, 4, 1);
        
        
        // Size 3 combinations ---------------------------------------------------------------------
        $combinationList3 = $mathCombination->getCombinations($this->_sourceDataSet, 3);
        $expectedList3 = [
            ['a' => 5, 'b' => 6, 'c' => 8],
            ['a' => 5, 'b' => 6, 'd' => 10],
            ['a' => 5, 'c' => 8, 'd' => 10],
            ['b' => 6, 'c' => 8, 'd' => 10],
        ];
        $this->_assertCombination($expectedList3, $combinationList3, 4, 3);
        
        
        // Size 4 combinations ---------------------------------------------------------------------
        $combinationList4 = $mathCombination->getCombinations($this->_sourceDataSet, 4);
        $expectedList4 = [
            ['a' => 5, 'b' => 6, 'c' => 8, 'd' => 10],
        ];
        $this->_assertCombination($expectedList4, $combinationList4, 1, 4);
        
        
        // Size 3 combinations ---------------------------------------------------------------------
        $combinationList = $mathCombination->getCombinations($this->_sourceDataSet);
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
        // Size 1 combinations ---------------------------------------------------------------------
        $combinationList1 = Combination::get($this->_sourceDataSet, 1);
        $expectedList1 = [
            ['a' => 5], ['b' => 6], ['c' => 8], ['d' => 10]
        ];
        $this->_assertCombination($combinationList1, $expectedList1, 4, 1);
        
        
        // Size 3 combinations ---------------------------------------------------------------------
        $combinationList3 = Combination::get($this->_sourceDataSet, 3);
        $expectedList3 = [
            ['a' => 5, 'b' => 6, 'c' => 8],
            ['a' => 5, 'b' => 6, 'd' => 10],
            ['a' => 5, 'c' => 8, 'd' => 10],
            ['b' => 6, 'c' => 8, 'd' => 10],
        ];
        $this->_assertCombination($expectedList3, $combinationList3, 4, 3);
        
        
        // Size 4 combinations ---------------------------------------------------------------------
        $combinationList4 = Combination::get($this->_sourceDataSet, 4);
        $expectedList4 = [
            ['a' => 5, 'b' => 6, 'c' => 8, 'd' => 10],
        ];
        $this->_assertCombination($expectedList4, $combinationList4, 1, 4);
        
        
        // Size 3 combinations ---------------------------------------------------------------------
        $combinationList = Combination::get($this->_sourceDataSet);
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

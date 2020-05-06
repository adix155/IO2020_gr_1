using System;
using System.Text;
using System.Collections;
using System.Collections.Generic;


/// <summary>
/// A screen that shows the results of the analysis.
/// </summary>
public class ResultsScreen
{

  #region Attributes

  /// <summary>
  /// A singleton instance of the class.
  /// </summary>
  private static ResultsScreen resultsScreen = null;

  #endregion


  #region Public methods

  /// <summary>
  /// Redraws all elements of the GUI updating all the elements with the proper
  /// contents
  /// </summary>
  /// <returns></returns>
  public void RefreshScreen()
  {
    throw new Exception("The method or operation is not implemented.");
  }

  /// <summary>
  /// A function to get the singleton instance of the class, or create it if id doesnt
  /// exist.
  /// </summary>
  /// <returns>ResultsScreen</returns>
  public static ResultsScreen ResultsScreenInstance()
  {
        if (resultsScreen == null)
        {
             resultsScreen = new ResultsScreen();
        }
        return resultsScreen;     
  }

  #endregion


  #region Private methods

  /// <summary>
  /// A private constructor.
  /// </summary>
  /// <returns></returns>
  private ResultsScreen()
  {
        RefreshScreen();
  }

  #endregion


}


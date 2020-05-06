using System;
using System.Text;
using System.Collections;
using System.Collections.Generic;


/// <summary>
/// 
/// </summary>
public class VisualsController
{

    #region Attributes

    /// <summary>
    /// A controllers reference to the Selection Screen class.
    /// </summary>
    private SelectionScreen selectionScreen = SelectionScreen.SelectionScreenInstance();


  /// <summary>
  /// A controllers reference to the Confirmation Screen class.
  /// </summary>
  private ConfirmationScreen confirmationScreen=ConfirmationScreen.ConfirmationScreenInstance();


    /// <summary>
    /// A controllers reference to the Login Screen class.
    /// </summary>
    private LoginScreen loginScreen = LoginScreen.LoginScreenInstance();


  /// <summary>
  /// A controllers reference to the Results Screen class.
  /// </summary>
  private ResultsScreen resultsScreen=ResultsScreen.ResultsScreenInstance();


  /// <summary>
  /// A singleton instance of the class.
  /// </summary>
  private static VisualsController visualsController;

  /// <summary>
  /// A controllers reference to the Confirmation Screen class.
  /// </summary>
  private RecordingEditScreen recordingEditScreen=RecordingEditScreen.RecordingEditScreenInstance();


    /// <summary>
    /// Idk if this will be neede. Later can be of a type that all screens inherit from.
    /// </summary>
    private int activeScreen;

  #endregion


  #region Public methods

  /// <summary>
  /// A function to get the singleton instance of the class, or create it if id doesnt
  /// exist.
  /// </summary>
  /// <returns>VisualsController</returns>
  public static VisualsController VisualsControllerInstance()
  {
        if (visualsController == null)
        {
             visualsController = new VisualsController();
        }
        return visualsController;     
  }

  /// <summary>
  /// If the active screen is selectionScreen it just calls the RefreshScreen()
  /// function of the selectionScreen. Otherwise it hides the active screen, switches
  /// it to the selectionScreen, shows it and calls the RefreshScreen() function.
  /// </summary>
  /// <returns></returns>
  public void ShowSelectionScreen()
  {
    throw new Exception("The method or operation is not implemented.");
  }

  /// <summary>
  /// If the active screen is confirmationScreen it just calls the RefreshScreen()
  /// function of the confirmationScreen. Otherwise it hides the active screen,
  /// switches it to the confirmationScreen and passes it the appropariate parameters,
  /// shows it and calls the RefreshScreen() function.
  /// </summary>
  /// <param name="selectedRecording">A recording selected in the previous screen. Alternatively we can just pass a int id.</param>
  /// <returns></returns>
  public void ShowConfirmationScreen(RecordingData selectedRecording)
  {
    throw new Exception("The method or operation is not implemented.");
  }

  /// <summary>
  /// If the active screen is confirmationScreen it just calls the RefreshScreen()
  /// function of the confirmationScreen. Otherwise it hides the active screen,
  /// switches it to the confirmationScreen, shows it and calls the RefreshScreen()
  /// function.
  /// </summary>
  /// <returns></returns>
  public void ShowLoginScreen()
  {
    throw new Exception("The method or operation is not implemented.");
  }

  /// <summary>
  /// If the active screen is resultsScreen it just calls the RefreshScreen() function
  /// of the resultsScreen. Otherwise it hides the active screen, switches it to the
  /// resultsScreen, shows it and calls the RefreshScreen() function.
  /// </summary>
  /// <param name="resultParameters">The calculated parameters to be displayed in a nice way on the screen.</param>
  /// <param name="processedRecording">The data of the recording to be displayed (if the user has proper authorization) on the results screen.</param>
  /// <returns></returns>
  public void ShowResultsScreen(double[] resultParameters, RecordingData processedRecording)
  {
    throw new Exception("The method or operation is not implemented.");
  }

  /// <summary>
  /// If the active screen is recordingEditScreen it just calls the RefreshScreen()
  /// function of the recordingEditScreen. Otherwise it hides the active screen,
  /// switches it to the recordingEditScreen, shows it and calls the RefreshScreen()
  /// function.
  /// </summary>
  /// <param name="recordData">The data of the recording to be edited.</param>
  /// <returns></returns>
  public void ShowRecordingEditScreen(RecordingData recordData)
  {
    throw new Exception("The method or operation is not implemented.");
  }

  #endregion


  #region Private methods

  /// <summary>
  /// A private constructor.
  /// </summary>
  /// <returns></returns>
  private VisualsController()
  {
  }

  #endregion


}


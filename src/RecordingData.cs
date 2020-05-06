using System;
using System.Text;
using System.Collections;
using System.Collections.Generic;

/// <summary>
/// 
/// </summary>
public class RecordingData
{

    #region Attributes

    /// <summary>
    /// 
    /// </summary>
    private string firstName;


  /// <summary>
  /// 
  /// </summary>
  private string lastName;


  /// <summary>
  /// 
  /// </summary>
  private char gender;


  /// <summary>
  /// 
  /// </summary>
  private int age;


  /// <summary>
  /// 
  /// </summary>
  private int ID;


  /// <summary>
  /// Either a path to the file, or somehow the recording itself in some sort of
  /// variable.
  /// </summary>
  private string voiceRecording;

  #endregion


  #region Public methods

  /// <summary>
  /// A constructor that loads all relevant data from the specified input file and
  /// creates the object of RecordingData with appropriately filled fields.
  /// </summary>
  /// <param name="pathToData">A path to the file containing the recording data.</param>
  /// <returns></returns>
  public RecordingData(string pathToData)
  {
    throw new Exception("The method or operation is not implemented.");
  }

  #endregion


}


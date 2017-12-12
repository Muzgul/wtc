//Enter header here
#include <stdio.h>
#include "get_next_line.h"

int		count_size(t_list **head)
{
//printf("count_size\n");
	t_list	*current;
	int		count;

	current = *head;
	count = 0;
	while (current != NULL)
	{
		count += current->content_size;
		current = current->next;
	}
	return (count);
}

int		make_line(char **line, t_list **head)
{
//printf("make_line\n");
	t_list	*current;
	char 	*tempStr;
	int		tempInt;

	if (head == NULL)
		return (-1);
	*line = ft_strnew(count_size(head));
	current = *head;
	while (current != NULL && current->content != NULL)
	{
// 		tempInt = ft_strsearch(current->content, '\n');
// printf("TempInt: %d\n", tempInt);
// 		if (tempInt != -1)
// 		{
// 			tempStr = ft_strnew(tempInt);
// 			tempStr = ft_strncpy(tempStr, current->content, tempInt);
// 		}
// 		else
// 			tempStr = current->content;
// printf("tempStr: %s\n", tempStr);
		tempStr = ft_strnew(current->content_size);
		tempStr = ft_strncpy(tempStr, current->content, current->content_size);
		*line = ft_strjoin(*line, tempStr);
		// if (tempStr != current->content && tempStr != NULL)
		// 	free(tempStr);
		// if (current->content != NULL)
		// {
		// 	free(current->content);
		// 	current->content = NULL;
		// }
		current = current->next;
	}
	tempInt = count_size(head);
	// while (*head != NULL)
	// {
	// 	current = *head;
	// 	*head = current->next;
	// 	free(current);
	// 	current = NULL;
	// }

	(*line)[tempInt] = '\0';
	return (tempInt);
}

int		read_to_list(const int fd, t_list **head)
{
//printf("read_to_list\n");
	static char	*save = NULL;
	char		*temp;
	char		buff[BUFF_SIZE + 1];
	int 		readStatus;
	int			tempInt;
	t_list		*new;

	temp = ft_strnew(BUFF_SIZE + 1);
	readStatus = 1;
// printf("Save: %s\n", save);
	if (save != NULL && ft_strlen(save) > 0)
	{
// printf("Save: %s AND SaveLen:%zu\n", save, ft_strlen(save));
		ft_strcpy(temp, save);
		free(save);
		save = NULL;
	}
	else
	{
		readStatus = read(fd, buff, BUFF_SIZE);
//printf("post read- readStatus: %i\n", readStatus);
		if (readStatus <= 0)
			return (readStatus);
		buff[readStatus] = '\0';
		ft_strcpy(temp, (char *)&buff);
	}
	
	tempInt = ft_strsearch(temp, '\n');
// printf("Temp: %s\nTempInt: %i\n", temp, tempInt);
	if (tempInt >= 0)
	{
		if (tempInt > 0)
			new = ft_lstnew(temp, tempInt);
		if (tempInt != (BUFF_SIZE - 1) && tempInt != 0)
		{
			save = ft_strnew(BUFF_SIZE - tempInt);
			ft_strcpy(save, &temp[tempInt]);
		}
		if (tempInt == 0)
		{
			save = ft_strnew(BUFF_SIZE - 1);

			if (count_size(head) == 0)
			{
				if (temp[0] == temp[1])
				{
					ft_strcpy(save, &temp[1]);
					return (-3);
				}
				else
				{
					ft_strcpy(save, &temp[1]);
					return (1);
				}
			}
			ft_strcpy(save, &temp[0]);
			return (-2);
			//if head has content, print
			//if head empty, and one newline: read again
				//if two new lines, return 3
		}
		readStatus = -2;
// printf("Returning -2\n");
		//new line found and not at [0]
	}
	if (tempInt == -1)
		new = ft_lstnew(temp, ft_strlen(temp));
		//new line not found
	if (temp != NULL)
		free(temp);
printf("NEW: %s\n", new->content);
	ft_lstadd(head, new);
	return (readStatus);
}

int		get_next_line(const int fd, char **line)
{
//printf("get_next_line\n");
	int		readStatus;
	int		makeStatus;
	t_list	*head;

	if (line == NULL)
		return (-1);
	readStatus = 1;
	head = NULL;
	while (readStatus > 0)
	{
		readStatus = read_to_list(fd, &head);
	}
	makeStatus = make_line(line, &head);
printf("Makestatus: %i\n", makeStatus);
printf("ReadStatus: %i\n", readStatus);
printf("Return 1\n");
	if (readStatus == -3)
	{
		(*line) = ft_strnew(1);
		return (1);
	}
printf("Return 0\n");
	if (readStatus == 0 && makeStatus == 0)
		return (0);
printf("Return 1\n");
	if (readStatus == -2 || makeStatus > 0)
		return (1);
printf("Return -1\n");
	return (-1);
}